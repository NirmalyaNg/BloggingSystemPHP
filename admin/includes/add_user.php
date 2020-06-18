<h2 style="margin-left:14px;">ADD USER</h2>
<div class="col-md-7">
  <form method="post" action="includes/functions.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="">User Name</label>
      <input type="text" name="user_name" placeholder="User Name" class="form-control">
    </div>
    <div class="form-group">
      <label for="">User Email</label>
      <input type="email" name="user_email" placeholder="User Email" class="form-control">
    </div>
    <div class="form-group">
      <label for="">User Role</label>
      <select name="user_role" class="form-control">
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
        <option value="author">Author</option>
      </select>
    </div>
    <div class="form-group">
      <label for="">User Password</label>
      <input type="text" name="user_password" placeholder="User Password" class="form-control">
    </div>
    <div class="form-group">
      <label for="">User Image</label>
      <input type="file" name="user_image" class="form-control">
    </div>
    <input type="submit" name="add_user" class="btn btn-primary" value="Add User">
  </form>
</div>