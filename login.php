<?php include("includes/header.php"); ?>
<?php
if(isset($_POST['login'])){
  $email = mysqli_real_escape_string($connection,$_POST['email']);
  $pass = mysqli_real_escape_string($connection,$_POST['pass']);

  if(!empty(trim($email)) &&  !empty(trim($pass))){
    $query = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      $original_pass = $row['user_password'];
      if($pass === $original_pass){
        $_SESSION['user'] = $row;
        header("Location:index.php");
      }else{
        echo "Wrong Password";
      }
    }else{
      echo "Not registered";
    }
  }else{
    echo "Empty fields";
  }
}

?>