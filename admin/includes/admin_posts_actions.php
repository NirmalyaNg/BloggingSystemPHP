<?php
include("functions.php");
if(isset($_GET['action'])){
  $action = $_GET['action'];
  $id = $_GET['id'];
  
  switch($action){
    case 'unapprove':
      unapprove_post($id);
    break;
    case 'approve':
      approve_post($id);
    break;
    case 'delete':
      delete_post($id);
    break;
  }
}


?>