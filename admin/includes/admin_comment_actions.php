<?php
include("functions.php");
if(isset($_GET['action'])){
  $action = $_GET['action'];
  $id = $_GET['id'];
  
  switch($action){
    case 'unapprove':
      unapprove($id);
    break;
    case 'approve':
      approve($id);
    break;
    case 'delete':
      delete_comment($id);
    break;
  }
}


?>