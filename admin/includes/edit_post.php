<?php

$sql = "SELECT  * FROM categories";
$res = mysqli_query($connection,$sql);
if(!$res){
  die("Query Failed ".mysqli_error($connection));
}

$query = "SELECT * FROM posts WHERE post_id = '$id'";
$get_post = mysqli_query($connection,$query);
if(!$get_post){
  die("Query Failed ".mysqli_error($connection));
}
$row=mysqli_fetch_assoc($get_post);
$post_id = mysqli_real_escape_string($connection,$row['post_id']);
$post_title = mysqli_real_escape_string($connection,$row['post_title']);
$post_author = mysqli_real_escape_string($connection,$row['post_author']);
$post_category = mysqli_real_escape_string($connection,$row['post_category']);
$post_content = mysqli_real_escape_string($connection,$row['post_content']);
$post_tags = mysqli_real_escape_string($connection,$row['post_tags']);
$post_status = mysqli_real_escape_string($connection,$row['post_status']);
$post_date = mysqli_real_escape_string($connection,$row['post_date']);
$post_comment_count = mysqli_real_escape_string($connection,$row['post_comment_count']);
$post_views = mysqli_real_escape_string($connection,$row['post_views']);
$post_image = mysqli_real_escape_string($connection,$row['post_image']);

?>
<h2 style="margin-left:14px;">EDIT POST</h2>
<div class="col-md-7">
  <?php
    if(isset($_GET['msg']) && $_GET['msg'] === 'edit_success'){
      echo "<div class='alert alert-success'>Post Edited Successfully    <a href='../single_post.php?post_id={$post_id}' style='margin-left:5px;'>View The Post</a></div>";
    }
  ?>
  <form method="post" action="includes/functions.php" enctype="multipart/form-data">
  <input type="hidden" name="id" value=<?php echo $post_id; ?> >
    <div class="form-group">
      <label for="">Post Title</label>
      <input type="text" name="title" placeholder="Post Title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
      <label for="">Post Author</label>
      <input type="text" name="author" placeholder="Post Author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
      <label for="">Post Category</label>
      <select name="category" class="form-control">
      <?php 
        while($row = mysqli_fetch_assoc($res)){
          $cat_title = $row['cat_title'];
          if($cat_title == $post_category){
            echo "<option value='$cat_title' selected>{$cat_title}</option>";
          }else{
            echo "<option value='$cat_title'>{$cat_title}</option>";
          }
          
        }
      ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Post Tags</label>
      <input type="text" name="tags" placeholder="Separate Tags with a comma" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
      <label for="">Post Status</label>
      <select name="status" class="form-control">
      <?php if($post_status == 'draft') { ?>
        <option value="draft" selected>Draft</option>
        <option value="published">Published</option>
      <?php }else { ?>
        <option value="draft" >Draft</option>
        <option value="published" selected>Published</option>
      <?php  } ?>
      </select>
    </div>
    
    <div class="form-group">
      <label for="">Post Image</label>
      <br>
      <img src="images/<?php echo $post_image; ?>" alt="Image" class="image-responsive" width=100>
      <br>
      <input type="file" name="image" class="form-control" style="margin-top:10px;">
    </div>
    <div class="form-group">
      <label for="">Post Content</label>
      <textarea name="content" id='editor1' style="resize:none;" class="form-control"><?php echo $post_content; ?></textarea>
    </div>
    <input type="submit" name="edit" class="btn btn-success" value="Edit Post">
  </form>
</div>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace( 'editor1' );
  </script>
