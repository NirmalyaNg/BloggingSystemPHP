<?php  
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'Blogging_system';

$connection = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if(!$connection){
  die("Could not connect to Database ".mysqli_error($connection));
}

?>