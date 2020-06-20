<?php
$query = "SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT 3";
$result = mysqli_query($connection,$query);
if(!$result){
  die("Query Failed ".mysqli_error($connection));
}
?>

<!-- Login Section -->

<?php if(!isset($_SESSION['user'])){ ?>
<div class="sidebar-box">
  <h3 class="heading">Login Here</h3>
    <form action="login.php" method="Post">
      <div class="form-group">
        <input type="email" name="email" placeholder="Enter Email" class="form-control">
      </div>
      <div class="form-group">
        <input type="password" name="pass" placeholder="Enter Password" class="form-control">
      </div>
      <input type="submit" name="login" value="Login" class="btn btn-primary">
    </form>
    <!--Signup button-->
    <a href="#" class="btn btn-primary">SIGNUP</a>
</div>
<?php }else{
  ?>
  <div class="sidebar-box">
    <div class="bio text-center">
      <?php $img = $_SESSION['user']['user_pic']; ?>
      <img src="admin/user_images/<?php echo $img; ?>" alt="Image Placeholder" style="border-radius:0px;">
      <div class="bio-body">
        <h2 class="heading"><?php echo $_SESSION['user']['user_name']; ?></h2>
      </div>
      <a href="logout.php" class="btn btn-primary btn-sm">Logout</a>
    <?php 
    $currentFile = $_SERVER["PHP_SELF"]; //To get the entire url starting after localhost
    $parts = Explode('/', $currentFile);
    $current_page_name = $parts[count($parts) - 1];


    if($_SESSION['user']['user_role'] === 'admin'){
      echo "<a href='admin/index.php' class='btn btn-outline-primary btn-sm'>Admin Section</a>";
      //The edit post button should be displayed only on the single_post.php page
      if($current_page_name === 'single_post.php'){
        echo "<a href='admin/posts.php?source=edit_post&id={$post_id}' class='btn btn-primary btn-sm mt-2'>Edit Post</a>";
      }
    }else if($_SESSION['user']['user_role'] === 'author'){
      echo "<a href='admin/index.php' class='btn btn-outline-primary btn-sm'>Author Section</a>";
      if($current_page_name === 'single_post.php' && $post_author == $_SESSION['user']['user_name']){
        echo "<a href='admin/posts.php?source=edit_post&id={$post_id}' class='btn btn-primary btn-sm mt-2'>Edit Post</a>";
      }
    }
    ?>
    </div>
  </div>
<?php } ?>






<div class="sidebar-box">
  <h3 class="heading">Recent Posts</h3>
  <div class="post-entry-sidebar">
    <ul>


<?php
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

      <li>
        <a href="single_post.php?post_id=<?php echo $post_id; ?>">
          <img src="admin/images/<?php echo $post_image; ?>" alt="Image placeholder" class="mr-4" class="img-responsive">
          <div class="text">
            <h4><?php echo $post_title; ?></h4>
            <div class="post-meta">
              <span class="mr-2"><?php echo $post_date; ?> </span>
            </div>
          </div>
        </a>
      </li>

<?php } ?>
    </ul>
  </div>
 </div>


 