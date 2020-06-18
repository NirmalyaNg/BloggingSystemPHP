<?php $posts_page = 'posts.php'; ?>
<?php include 'includes/header.php'; ?>

<div id="wrapper">

<!-- Navigation -->
<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
          <!-- Display posts in a table format -->
          

          <!--  -->
        <?php  
        if(isset($_GET['source'])){
          $source = $_GET['source'];
          if(isset($_GET['id'])){
            $id = $_GET['id'];
          }

          switch($source){
            case 'add_new':
              include("includes/add_post.php");
            break;
            case 'edit_post':
              include("includes/edit_post.php");
            break;
            default:
            include("includes/view_all_posts.php");
          }
        }
        ?>

      </div>
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

