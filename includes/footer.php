<?php
$query = "SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT 3";
$result = mysqli_query($connection,$query);
if(!$result){
  die("Query Failed ".mysqli_error($connection));
}
?>

<footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3>About Us</h3>
              <p class="mb-4">
                <img src="images/footer.jpg" alt="Image placeholder" class="img-fluid">
              </p>

              <p>Lorem ipsum dolor sit amet sa ksal sk sa, consectetur adipisicing elit. Ipsa harum inventore reiciendis. <a href="#">Read More</a></p>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-7">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>
                      <?php 
                      while($row = mysqli_fetch_assoc($result)){
                        ?>
                      <li>
                        <a href="single_post.php?post_id=<?php echo $row['post_id']; ?>">
                          <img src="admin/images/<?php echo $row['post_image'] ?>" alt="Image placeholder" class="mr-4">
                          <div class="text">
                            <h4><?php echo $row['post_title']; ?></h4>
                            <div class="post-meta">
                              <span class="mr-2"><?php echo $row['post_date']; ?><br></span>
                              <span><span class="fa fa-comments"></span> <?php echo $row['post_comment_count'];  ?></span>
                            </div>
                          </div>
                        </a>
                      </li>   
                        <?php
                      }              
                      ?>
                      
                    </ul>
                  </div>
                </div>
                <div class="col-md-1"></div>
                
                <div class="col-md-4">

                  <div class="mb-5">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                      <?php 
                      $query="SELECT * FROM categories ORDER BY cat_id DESC LIMIT 5";
                      $result = mysqli_query($connection,$query);
                      while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['cat_id'];
                        ?>
                          <li><a href='category_posts.php?cat_id=<?php echo $cat_id?>'><?php echo $row['cat_title']; ?></a></li>
                        <?php
                      }
                      ?>
                    </ul>
                  </div>
                  
                  <div class="mb-5">
                    <h3>Social</h3>
                    <ul class="list-unstyled footer-social">
                      <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                      <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                      <li><a href="#"><span class="fa fa-linkedin"></span> LinkedIn</a></li>
                      <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p class="small">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved |</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- END footer -->