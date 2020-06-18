<?php $users_page = 'users.php'; ?>
<?php include 'includes/header.php'; ?>

<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">

					  <!--  -->
            <?php  
            if(isset($_GET['source'])){
              $source = $_GET['source'];
              if(isset($_GET['id'])){
                $id = $_GET['id'];
              }

              switch($source){
                case 'view_all_users':
                  include("includes/view_all_users.php");
                break;
                case 'add_user':
                  include("includes/add_user.php");
                break;
                case 'edit_user':
                  include("includes/edit_user.php");
                break;
                default:
                include("includes/view_all_users.php");
              }
            }else{
              include("includes/view_all_users.php");
            }
        ?>
				</div>


			</div>

			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
