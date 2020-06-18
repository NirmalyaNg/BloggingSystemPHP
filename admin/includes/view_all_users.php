<h1 class="page-header " style="margin-left:10px;">Welcome to the Administration Panel</h1>

<!-- Bulk options -->
<div class="table-responsive" style="margin-top:10px;">
<?php 
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
  echo "<div class='alert alert-success' style='width:300px;'>{$msg}</div>";
}
?>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>UserID</th>
        <th>Username</th>
        <th>User Email</th>
        <th>User Image</th>
        <th>User Role</th>
        <th>Edit User</th>
        <th>Make Subs</th>
        <th>Make Admin</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php view_users(); ?>
    </tbody>
  </table>
</div>


<script>
let alert = document.querySelector('.alert');
if(alert){
  setTimeout(()=>{
    alert.style.display='none';
  },2000);
}

</script>