<?php  

if(isset($_POST['apply'])){
  if(isset($_POST['checkBoxArray'])){
    $action = $_POST['bulk'];
    switch($action){
      case 'delete':
        for($i = 0; $i < count($_POST['checkBoxArray']);$i++){
          $id = $_POST['checkBoxArray'][$i];
          $query = "DELETE FROM posts WHERE post_id = '$id' ";
          $result = mysqli_query($connection,$query);
          if(!$result){
            die("Query Failed ".mysqli_error($connection));
          }
        }
      break;
      case 'draft':
        for($i = 0; $i < count($_POST['checkBoxArray']);$i++){
          $id = $_POST['checkBoxArray'][$i];
          $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = '$id' ";
          $result = mysqli_query($connection,$query);
          if(!$result){
            die("Query Failed ".mysqli_error($connection));
          }
        }
      break;
      case 'publish':
        for($i = 0; $i < count($_POST['checkBoxArray']);$i++){
          $id = $_POST['checkBoxArray'][$i];
          $query = "UPDATE posts SET post_status = 'published' WHERE post_id = '$id' ";
          $result = mysqli_query($connection,$query);
          if(!$result){
            die("Query Failed ".mysqli_error($connection));
          }
        }
      break;
  }
}

}

?>
<h1 class="page-header " style="margin:5px 0px 20px 10px;">Welcome to the Administration Panel</h1>

<!-- Bulk options -->
<form action="" method="POST">
<div class="col-xs-4" id="bulkOptionContainer" style="padding-left:0px;">
  <select required name="bulk" class="form-control" id="">
                        
    <option disabled="true" >Select Options</option>
    <option value="publish">Publish</option>
    <option value="draft">Draft</option>
    <option value="delete">Delete</option>
  </select>
</div>
<div class="col-xs 4">
    <input type="submit" name="apply" value="Apply" class="btn btn-primary">
</div>
<div class="table-responsive" style="margin-top:10px;">

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Date</th>
        <th>Image</th>
        <th>Comments</th>
        <th>Views</th>
        <th>Tags</th>
        <th>Status</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody id="tbody">
      <?php show_posts_by_author(); ?>
    </tbody>
  </table>
  </form>
</div>

<script>
let all_checked = document.getElementById('selectAllBoxes');
all_checked.addEventListener('click',function(){
  let all_checks = document.querySelectorAll('.checkboxes');
  for(let checkbox of all_checks){
    if(all_checked.checked == true ){
      checkbox.checked = true;
    }else{
      checkbox.checked = false;
    }
  }
});

</script>

<script src="js/input_search.js"></script>