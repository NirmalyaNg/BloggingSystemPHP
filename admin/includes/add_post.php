<?php
$sql = "SELECT  * FROM categories";
$res = mysqli_query($connection,$sql);
if(!$res){
  die("Query Failed ".mysqli_error($connection));
}

?>
<h2 style="margin-left:14px;">ADD POST</h2>
<div class="col-md-7">
  <form method="post" action="includes/functions.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="">Post Title</label>
      <input type="text" name="title" placeholder="Post Title" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Post Author</label>
      <input type="text" name="author" placeholder="Post Author" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Post Category</label>
      <select name="category" class="form-control">
      <?php 
        while($row = mysqli_fetch_assoc($res)){
          $cat_title = $row['cat_title'];
          echo "<option value='$cat_title'>{$cat_title}</option>";
        }
      ?>
      </select>
    </div>
    <div class="form-group">
      <label for="">Post Tags</label>
      <input type="text" name="tags" placeholder="Separate Tags with a comma" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Post Status</label>
      <select name="status" class="form-control">
        <option value="draft">Draft</option>
        <option value="published">Published</option>
      </select>
    </div>
    <div class="form-group">
      <label for="">Post Image</label>
      <input type="file" name="post_image" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Post Content</label>
      <textarea name="content" style="resize:none;" class="form-control"></textarea>
    </div>
    <input type="submit" name="publish" class="btn btn-primary" value="Add Post">
  </form>
</div>