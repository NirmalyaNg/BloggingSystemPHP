<!-- ---------------------------For Side category section---------------------------------------------- -->


<?php 
$query = "SELECT * FROM categories ORDER BY cat_id DESC LIMIT 6";
$result = mysqli_query($connection,$query);
?>

<div class="sidebar-box">
  <h3 class="heading">Categories</h3>
  <ul class="categories">
  <?php while($row=mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    //get the number of posts for that particular category
    $query = "SELECT * FROM posts WHERE post_category = '$cat_title'";
    $result1 = mysqli_query($connection,$query);
    $count = mysqli_num_rows($result1);

    echo "<li><a href='category_posts.php?cat_id={$cat_id}'>{$cat_title} <span>({$count})</span></a></li>";
  }
  ?>
  </ul>
</div>