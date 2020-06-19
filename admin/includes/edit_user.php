<?php

$query = "SELECT * FROM users WHERE user_id = '$id'";
$result= mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result);
$user_id = $row['user_id'];
$user_name = $row['user_name'];
$user_email = $row['user_email'];
$user_pic = $row['user_pic'];
$user_role = $row['user_role'];
$user_password = $row['user_password'];



?>
<h2 style="margin-left:14px;">EDIT USER</h2>
<div class="col-md-7">
  <?php
    if(isset($_GET['msg']) && $_GET['msg'] === 'edit_success'){
      echo "<div class='alert alert-success'>User Details Edited </div>";
    }
  ?>
  <form method="post" action="includes/functions.php" enctype="multipart/form-data">
  <input type="hidden" name="user_id" value=<?php echo $user_id; ?> >
    <div class="form-group">
      <label for="">User Name</label>
      <input type="text" name="user_name"  class="form-control" value="<?php echo $user_name; ?>">
    </div>
    <div class="form-group">
      <label for="">User email</label>
      <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
      <label for="">User Role</label>
      <select name="user_role" class="form-control">
      <?php 
          if($user_role == 'admin'){
            echo "<option value='admin' selected>Admin</option>";
            echo "<option value='subscriber'>Subscriber</option>";
            echo "<option value='author'>Author</option>";
          }else if($user_role == 'author'){
            echo "<option value='author' selected>Author</option>";
            echo "<option value='admin'>Admin</option>";
            echo "<option value='subscriber'>Subscriber</option>";
          }else{
            echo "<option value='subscriber' selected>Subscriber</option>";
            echo "<option value='admin'>Admin</option>";
            echo "<option value='author'>Author</option>";
          }
          
        
      ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">User Password</label>
      <input type="text" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
      <label for="">User Image</label>
      <br>
      <img src="user_images/<?php echo $user_pic; ?>" alt="Image" class="image-responsive" width=100>
      <br>
      <input type="file" name="user_image" class="form-control" style="margin-top:10px;">
    </div>
    <input type="submit" name="edit_user" class="btn btn-success" value="Update User">
  </form>
</div>