<?php
$query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 4";
$result = mysqli_query($connection,$query);
$tags_array = [];
if($result){
  while($row = mysqli_fetch_assoc($result)){
    $tags = $row['post_tags'];
    $tags_row = explode(',',$tags);
    foreach ($tags_row as $key => $value) {
      if(!in_array( strtolower($value),$tags_array)){
        array_push($tags_array,strtolower($value));
      }
    }
  }
}  
?>
<div class="sidebar-box">
  <h3 class="heading">Tags</h3>
  <ul class="tags">
  <?php  
    foreach($tags_array as $key => $value){
      echo "<li><a href='#'>{$value}</a></li>";
    }
  
  ?>
  </ul>
</div>