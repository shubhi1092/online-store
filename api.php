<?php
 
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// get the access token from the header
$a_token = $_SERVER['HTTP_X_ACCESS_TOKEN'];

// connect to the mysql database: Replace the servername, username and password.
$servername = 'localhost';
$username = 'root';
$password = '';
$link = mysqli_connect($servername, $username, $password, 'online store');
mysqli_set_charset($link,'utf8');

// check if the access token is valid.
$sql1 = "select * from `users` WHERE Access_token='$a_token'";
$result1 = mysqli_query($link,$sql1);
if (!$result1 || mysqli_num_rows($result1)==0) {
  http_response_code(404);
  echo "<br/>You are not authorised. Access token is invalid.";
  die();
}

// retrieve the table and key from the path
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

//escape the columns and values from the input object
if($method== "POST" || $method=="PUT"){
$columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
$values = array_map(function ($value) use ($link) {
 if ($value===null) return null;
 return mysqli_real_escape_string($link,(string)$value);
},array_values($input));
}

if($method=="POST"){
$set = '';
$col = '';
for ($i=0;$i<count($columns);$i++) {
 $col.=($i>0?',':'(').'`'.$columns[$i].'`';
 $set.=($i>0?',':'(').($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
$col.=')';
$set.=')';
}

if($method=="PUT"){
$set1 = '';
for ($i=0;$i<count($columns);$i++) {
 $set1.=($i>0?',':'').'`'.$columns[$i].'`=';
 $set1.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
}
}

// create SQL based on HTTP method
switch ($method) {
  case 'GET':
    $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
  case 'PUT':
    $sql = "update `$table` set $set1 where `ID`=$key"; break;
  case 'POST':
    $sql = "insert into `$table` $col values $set"; break;
  case 'DELETE':
    $sql = "delete from `$table` where `ID`=$key"; break;
}

// excecute SQL statement
$result = mysqli_query($link,$sql);

// die if SQL statement failed
if (!$result || ($method == 'GET' && mysqli_num_rows($result)==0)) {
  http_response_code(404);
  if(!$result){
	   echo "<br/>".mysqli_error($link);
  }
  else{
	  echo "<br/>MySQL returned empty result set";
  }
  die();
}
 
// print results, insert id or affected row count
header('Content-type: application/json');
http_response_code(200);
if ($method == 'GET') {
  echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  echo ']';
} elseif ($method == 'POST') { 
  echo "<br/>Product id $values[0] created.";
} elseif ($method == 'PUT') { 
  echo "<br/>".mysqli_affected_rows($link)." rows updated.";
  if(mysqli_affected_rows($link)=='0'){
	  echo "<br/> Either this product is already updated or product ID $key does not exist.";
  }
} else {
  echo "<br/>".mysqli_affected_rows($link)." rows deleted.";
  if(mysqli_affected_rows($link)=='0'){
	  echo "<br/> Product ID $key does not exist.";
  }
}
 
// close mysql connection
mysqli_close($link);
?>