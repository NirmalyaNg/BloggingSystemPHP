<?php $profile_page = 'profile.php'; ?>
<?php include 'includes/header.php';?>
<?php 
  if(!isset($_SESSION['user']) || $_SESSION['user']['user_role']!== 'admin' ){
    header("Location:../index.php");
  }
?>
<?php
$user_details = $_SESSION['user'];

?>
<div id="wrapper" style="overflow-x:hidden;">

  <!-- Navigation -->
  <?php include 'includes/navigation.php'; ?>
  <div id="page-wrapper" >

    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row" >
        <div class="col-lg-12">
				</div>
        <h1 class="page-header">Welcome to the Profile Page</h1>
      </div>
    </div>
<!-- /.row -->
<div class="row">
  <div class="col-md-5 col-lg-5 ">
    <img src="user_images/<?php echo $user_details['user_pic']; ?>" alt="Profile Picture" class="img-responsive" width=200>
    <h4 style="margin-top:20px;"><b>Email</b> <i class="fa fa-user"></i></h4>
    <p style="padding-bottom:10px;border-bottom:2px solid black;"><?php echo $user_details['user_email']; ?></p>
    <h4 style="margin-top:20px;"><b>Username</b> <i class="fa fa-user"></i></h4>
    <p style="padding-bottom:10px;border-bottom:2px solid black;"><?php echo $user_details['user_name']; ?></p>
    <h4 style="margin-top:20px;"><b>User Role</b> <i class="fa fa-key"></i></h4>
    <p style="padding-bottom:10px;border-bottom:2px solid black;margin-bottom:20px;"><?php echo $user_details['user_role']; ?></p>
    <a href="users.php?source=edit_user&id=<?php echo $user_details['user_id']; ?>" class="btn btn-primary">Edit Profile</a>
  </div> 
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


</body>

</html>
