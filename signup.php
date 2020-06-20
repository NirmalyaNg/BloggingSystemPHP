<?php include("includes/header.php");  ?>
<?php 
if(isset($_SESSION['user'])){
  header("Location:index.php");
}
if(isset($_POST['register'])){
  $empty = 0;
  foreach ($_POST as $key => $value) {
    if(empty(trim($value))){
      $empty += 1;
    }
  }
  if($empty >= 1){
    echo "<script>alert('Fields cannot be empty')</script>";
  }else{
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);

    //Check if already registered
    $check_already_registered = "SELECT * FROM users WHERE user_email = '$email'";
    $result1 = mysqli_query($connection,$check_already_registered);
    if(mysqli_num_rows($result1) >= 1){
      header("Location:signup.php?Email_Already_Registered");
    }else{
      $password = mysqli_real_escape_string($connection,$_POST['password']);
      $conpassword = mysqli_real_escape_string($connection,$_POST['conPassword']);
      if($password === $conpassword){
        $query = "INSERT INTO users (user_name,user_email,user_password,user_role,user_pic)  VALUES ('$username','$email','$password','subscriber','default.jpg')";
        $result = mysqli_query($connection,$query);
        if($result){
          header("Location:index.php?signup_msg");
        }
      }else{
        header("Location:signup.php?Passwords_does_not_match");
      }
    }
  }
}
?>

    <div class="wrap">
    <?php include("includes/navigation.php");  ?>
      <section class="site-section py-sm bg-primary">
        <div class="container">
         <div class="row">
           <div class="col-md-6 mx-auto my-4">
              <div class="card card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="email">User Email</label>
                    <input type="email" class="form-control" name="email" required>
                  </div>
                  <?php if(isset($_GET['Email_Already_Registered']))  { ?>
                  <div class="alert alert-danger">
                    Email Already Registered
                  </div>
                  <?php } ?>
                  <div class="form-group">
                    <label for="password">User Password</label>
                    <input type="password" class="form-control" name="password" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" name="conPassword" required>
                  </div>
                  <?php if(isset($_GET['Passwords_does_not_match']))  { ?>
                  <div class="alert alert-warning">
                    Password don't match
                  </div>
                  <?php } ?>
                  <input type="submit" class="btn btn-primary" name="register" value="Register">
                </form>
              </div>
           </div>
         </div>
        </div>
      </section>

      <?php include("includes/footer.php");   ?>
    
    </div>
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    
    <script src="js/main.js"></script>
    <script>
      let alert = document.querySelector('.alert');
      if(alert){
        setTimeout(()=>{
          alert.style.display = 'none';
        },3000);
      }  
    </script>
  </body>
</html>