<?php $comments_page = 'comments.php'; ?>
<?php include 'includes/header.php'; ?>
<?php $comment_obj = new Comment($connection);  ?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                          <h1 class="page-header">
                            Welcome to the Administration Panel
                        </h1>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover">
                            <thead>
                              <th>ID</th>
                              <th>Post</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Body</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Post ID</th>
                              <th>Approve</th>
                              <th>Unapprove</th>
                              <th>Delete</th>
                             
                            </thead>
                            <tbody>
                              <?php $comment_obj->getCommentsInAdminTable(); ?>
                            </tbody>
                          </table>
                        </div>
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

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
