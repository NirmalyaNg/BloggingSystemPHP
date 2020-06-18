<?php $categories_page = 'categories.php'; ?>
<?php include 'includes/header.php';?>
<div id="wrapper">
<!-- Navigation -->
  <?php include 'includes/navigation.php'; ?>
  <div id="page-wrapper">
    <div class="container-fluid">
    <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Welcome to the Administration Panel</h1>
					<div class="col-md-6">
            <div class="col-12">
              <form action="" method="post">
                <div class="form-group">
                  <input type="text" name="cat_title" placeholder="Category Title" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="cat_add" value="Add Category" class="btn btn-primary">
                </div>
              </form>
              <?php if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                $alert = $_GET['alert'] == 's' ? 'success' : 'danger';
                echo "<div class='alert alert-{$alert}'>{$msg}</div>";
              }  ?>
            </div>
            <?php if(isset($_GET['edit_category'])) {
              $cat_id = $_GET['edit_category'];
              $query=mysqli_query($connection,"SELECT * FROM categories WHERE cat_id = '$cat_id'");
              $row=mysqli_fetch_assoc($query);
              $cat_title = $row['cat_title'];
              ?>
            <div class="col-12" style="margin-top:30px;">
              <form action="" method="post">
                <div class="form-group">
                  <input type="hidden" name="id" value=<?php echo $cat_id; ?> >
                  <input name="cat_title" value=<?php echo $cat_title; ?> placeholder="Category Title" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" name="cat_edit" value="Edit Category" class="btn btn-primary">
                </div>
              </form>
              <?php if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                $alert = $_GET['alert'] == 's' ? 'success' : 'danger';
                echo "<div class='alert alert-{$alert}'>{$msg}</div>";
              }  ?>
            </div>
            <?php } ?>
					</div>
            <div class="col-md-6">
               <table class="table table-striped table-hover">
                 <thead class="bg-success">
                   <th>Category ID</th>
                   <th>Category Title</th>
                   <th>Edit</th>
                   <th>Delete</th>
                 </thead>
                 <tbody>
                  <?php show_category(); ?>
                 </tbody>
               </table>
						</div>
                <!-- /.row -->
          </div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->


    <script>
      let alert = document.querySelector('.alert');
      if(alert){
        setTimeout(()=>{
          alert.style.display = 'none';
          window.location('categories.php');
        },2000)
      }
    </script>

</body>

</html>
