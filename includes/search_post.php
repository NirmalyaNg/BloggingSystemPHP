<?php
if(isset($_POST['search'])){
  $search = $_POST['search'];
  
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
  $result = mysqli_query($connection,$query);
  if(mysqli_num_rows($result) === 0){
    echo "<div class='alert alert-danger'>Sorry, no search results found !</div>";
  }else{
    while($row = mysqli_fetch_assoc($result)){
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
    ?>
      <div class="col-md-6">
      <a href="single_post.php?post_id=<?php echo $post_id; ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
        <img src="admin/images/<?php echo $post_image; ?>" alt="Image placeholder" class="img-responsive">
        <div class="blog-content-body">
          <div class="post-meta">
            <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib"> Colorlib</span>&bullet;
            <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
            <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_comment_count; ?></span>
          </div>
          <h2><?php echo $post_title; ?></h2>
        </div>
      </a>
    </div>
    
    <?php } 
  }
}
?>
