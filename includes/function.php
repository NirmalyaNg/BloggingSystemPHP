<?php include("admin/includes/db.php"); ?>
<?php

function show_cat(){
  global $connection;

  $query = "SELECT * FROM categories LIMIT 4";
  $result = mysqli_query($connection,$query);

  while($row = mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    if($cat_title == $title){
      echo "<li class='nav-item'>
      <a class='nav-link active' href='category_posts.php?cat_id={$cat_id}'>{$cat_title}</a>
    </li> ";
    }else{
      echo "<li class='nav-item'>
    <a class='nav-link' href='category_posts.php?cat_id={$cat_id}'>{$cat_title}</a>
  </li> ";
    }
  }
}

?>