<?php
include("functions.php");
if(isset($_GET['action'])){
  $action = $_GET['action'];
  $id = $_GET['id'];
  
  switch($action){
    case 'make_admin':
      make_admin($id);
    break;
    case 'make_subscriber':
      make_subscriber($id);
    break;
    case 'delete_user':
      delete_user($id);
    break;
  }
}


?>