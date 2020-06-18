<?php include("includes/header.php");  ?>
<?php 
$link = 'localhost/blogging_system/index.php?msg=Not%20Logged%20In';
$linkParts = explode('?msg=', $link);
$link = $linkParts[0];

if(isset($_GET['msg'])){
  echo "<script>alert('You need to be logged in to view posts.')</script>";
  echo "<script>window.open('index.php','_self');</script>";
}

?>

    <div class="wrap">
    <?php include("includes/navigation.php");  ?>
      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4 mt-2">Latest Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">
                <?php include("includes/posts.php"); ?>
              </div>
            </div>

            <!-- END main-content -->

            <div class="col-md-12 col-lg-4 sidebar">
              <div class="sidebar-box search-form-wrap">
                <form action="search.php" class="search-form" method="POST">
                  <div class="form-group">
                    <span class="icon fa fa-search"></span>
                    <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter" name="search">
                  </div>
                </form>
              </div>
              <!-- END sidebar-box -->
            
              <!-- END sidebar-box -->  
             <?php include("includes/sidebar.php"); ?>
              <!-- END sidebar-box -->

             <?php include("includes/category.php"); ?>
              <!-- END sidebar-box -->

            <?php include('includes/tags.php');  ?>
            </div>
            <!-- END sidebar -->

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
  </body>
</html>