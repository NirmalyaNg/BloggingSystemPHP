<?php $index_page = 'index.php'; ?>
<?php include 'includes/header.php';?>
<?php 
  if(!isset($_SESSION['user']) || $_SESSION['user']['user_role'] == 'subscriber'){
    header("Location:../index.php");
  }
?>
<?php
//Get number of items for each section :categories,posts,comments,users
$users_count = getCount('users');
$comments_count = getCount('comments');
$categories_count = getCount('categories');
$posts_count = getCount('posts');




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
        <h1 class="page-header">Welcome to the Administration Panel</h1>
      </div>
    </div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div>Posts</div>
                        <div style="font-size:35px;"><?php echo $posts_count; ?></div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left"><a href="posts.php?source=view_all_posts">View Posts</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                      <div>Comments</div>
                      <div style="font-size:35px;"><?php echo $comments_count; ?></div>
                    </div>
                </div>
            </div>
            <a href="comment.php">
                <div class="panel-footer">
                    <span class="pull-left"><a href="comment.php">View Comments</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <?php if($_SESSION['user']['user_role'] === 'admin') {  ?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                        <div> Users</div>
                        <div style="font-size:35px;"><?php echo $users_count; ?></div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left"><a href="users.php">View Users</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <?php } ?>
    <?php if($_SESSION['user']['user_role'] === 'admin') {  ?>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                         <div>Categories</div>
                         <div style="font-size:35px;"><?php echo $categories_count; ?></div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left"><a href="categories.php">View Categories</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <?php } ?>
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
