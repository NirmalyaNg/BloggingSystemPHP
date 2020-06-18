<?php include("includes/header.php");  ?>
<?php $comment_obj = new Comment($connection);  ?>
<?php if(!isset($_SESSION['user'])){
  header("Location:index.php?msg=Not Logged In");
} ?>

    <div class="wrap">
    <?php include("includes/navigation.php");  ?>
     

    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

        <?php 
        if(isset($_GET['post_id'])){
          $post_id = $_GET['post_id'];
          //Get specific post details on which we clicked in the index.php page

          $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
          $result = mysqli_query($connection,$query);

          

        }else{
          header("Location:index.php");
        } 
        //Update views for the post
        if($_SESSION['user']['user_role'] !== 'admin'){
        $views = "UPDATE posts SET post_views = (post_views + 1) WHERE post_id = '$post_id'";
        $update_views = mysqli_query($connection,$views);
        if(!$update_views){
          die("Query Failed ".mysqli_error($connection));
        }
      }



        $row=mysqli_fetch_assoc($result);
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_category = $row['post_category'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_date = $row['post_date'];
        $post_comment_count = $row['post_comment_count'];
        $post_views = $row['post_views'];
        $post_image = $row['post_image'];

        //Get each tags from the string $post_tags in an array

        $post_tags_array = explode(',',$post_tags);
        ?>



          <div class="col-md-12 col-lg-8 main-content">
            <img src="admin/images/<?php echo $post_image; ?>" alt="Image" class="img-fluid mb-5">
             <div class="post-meta">
                <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib" class="mr-2"> <?php echo $post_author; ?></span>&bullet;
                <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_comment_count; ?></span>
             </div>
            <h1 class="mb-4"><?php echo $post_title; ?></h1>
            <a class="category mb-5" href="#"><?php echo $post_category; ?></a>
           
            <div class="post-content-body">
              <p><?php echo $post_content; ?></p>

              <!-- To display additional images for posts -->
            <!-- <div class="row mb-5">
              <div class="col-md-12 mb-4">
                <img src="images/img_7.jpg" alt="Image placeholder" class="img-fluid">
              </div>
              <div class="col-md-6 mb-4">
                <img src="images/img_9.jpg" alt="Image placeholder" class="img-fluid">
              </div>
              <div class="col-md-6 mb-4">
                <img src="images/img_11.jpg" alt="Image placeholder" class="img-fluid">
              </div>
            </div> -->
            
            </div>
            
            <div class="pt-5">
              <p>Category:  <a href="#"><?php echo $post_category; ?></a>  Tags: <?php foreach($post_tags_array as $key => $value){ echo "<a href='#'>#{$value}</a> " ;} ?></p>
            </div>

            <?php 

              if(isset($_GET['post_id'])){
                $post_id = $_GET['post_id'];
                if(isset($_POST['comment'])){
                  $name = $_POST['name'];
                  $email = $_POST['email'];
                  $comment_body = $_POST['comment_body'];
                  
                  //Create an instance of the comment class
                  
                  $comment_obj->add_comment($post_id,$name,$email,$comment_body);
                }
              }
            ?>

            <div class="pt-5">
              <h3 class="mb-5"><?php echo $comment_obj->getCommentCount($post_id); ?> Comments</h3>
               <ul class="comment-list">
                <!-- <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>Jean Doe</h3>
                    <div class="meta">January 9, 2018 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>  -->
                <?php $comment_obj->getApprovedComments($post_id); ?>
              </ul>
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="single_post.php?post_id=<?php echo $post_id; ?>" method="POST" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" class="form-control" id="email">
                  </div>
                  <!-- <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website">
                  </div> -->

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" cols="30" rows="10" class="form-control" name="comment_body"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary" name="comment">
                  </div>

                </form>
              </div>
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