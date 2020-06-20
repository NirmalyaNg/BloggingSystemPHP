<?php  include "db.php"; 
?>
<?php
//Utility function

function check_query($result){
  global $connection;
  if($result){
    return true;
  }else{
    die("Query Failed ".mysqli_error($connection));
  }
}


//-------------------------------------------------------------------------------------------
function add_category(){
  global $connection;

  //Check if add category form is submitted

  if(isset($_POST['cat_add'])){
    if(empty($_POST['cat_title'])){
      header("Location:categories.php?msg=Fields cannot be empty!&alert=d");
    }else{
      $cat_title = $_POST['cat_title'];
      $query = "INSERT INTO categories(cat_title) VALUES ('$cat_title') ";
      $result = mysqli_query($connection,$query);
      
      if(check_query($result)){
        header("Location:categories.php?msg=Category Added&alert=s");
      }
    }
  }
}


add_category();

function edit_category(){
  global $connection;

  //Check if add category form is submitted

  if(isset($_POST['cat_edit'])){
    if(empty($_POST['cat_title'])){
      header("Location:categories.php?msg=Fields cannot be empty!&alert=d");
    }else{
      $id = $_POST['id'];
      $cat_title = $_POST['cat_title'];
      $query = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id='$id'";
      $result = mysqli_query($connection,$query);
      
      if(check_query($result)){
        header("Location:categories.php?msg=Category Updated&alert=s");
      }
    }
  }
}
edit_category();



function show_category(){
  global $connection;
  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($result)){
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];

    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?edit_category={$cat_id}' class='btn btn-primary'>Edit</a></td>";
    echo "<td><a href='categories.php?delete_cat={$cat_id}' class='btn btn-danger'>Delete</a></td>";
    echo "</tr>";

  }
}


function delete_category(){
  global $connection;
  if(isset($_GET['delete_cat'])){
    $cat_id = $_GET['delete_cat'];
    $query = "DELETE FROM categories WHERE cat_id = '$cat_id'";
    $result = mysqli_query($connection,$query);
    if(check_query($result)){
      header("Location:categories.php?msg=Category Deleted.&alert=s");
    }
  }
}

delete_category();



function add_post(){
  global $connection;
  if(isset($_POST['publish'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category = $_POST['category'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];
    $post_date = date("l d F Y");
    $post_comment_count = 0;
    $post_views = 0;

    //File Upload Section
    $target_dir = "images/";
    $target_file = $_SERVER['DOCUMENT_ROOT'].'/blogging_system/admin/'.$target_dir . basename($_FILES["post_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["post_image"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["post_image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
      }

    $post_image_name = $_FILES['post_image']['name'];
    //Inserting into database
    $query = "INSERT INTO posts (post_title,post_category,post_author,post_content,post_date,post_image,post_comment_count,post_views,post_tags,post_status) VALUES ('$post_title','$post_category','$post_author','$post_content','$post_date','$post_image_name','$post_comment_count','$post_views','$post_tags','$post_status')";

    $exec = mysqli_query($connection,$query);
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
      header("Location:../posts.php?source=add_new");
    }else{
      header("Location:../posts.php?source=view_all_posts");
    }

  }
}
}

add_post();



function show_posts(){
  global $connection;
  $query = "SELECT * FROM posts";
  $result = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($result)){
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


    //Show only an exerpt of the content
    $post_content = substr($post_content,0,20).'..';
    ?>
    <tr id="title_row">
      <td><input type="checkbox" class="checkboxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
      <td><?php echo $post_id; ?></td>
      <td id="title"><a href="../single_post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a></td>
      <td><?php echo $post_category; ?></td>
      <td><?php echo $post_author; ?></td>
      <td><?php echo $post_date; ?></td>
      <td><img src="images/<?php echo $post_image; ?>" alt="" class="img-responsive" style="width:150px;"></td>
      <td><?php echo $post_comment_count; ?></td>
      <td><?php echo $post_views; ?></td>
      <td><?php echo $post_tags; ?></td>
      <td><?php echo $post_status; ?></td>
      <td><a href="includes/admin_posts_actions.php?action=approve&id=<?php echo $post_id; ?>">Approve</a></td>
      <td><a href="includes/admin_posts_actions.php?action=unapprove&id=<?php echo $post_id; ?>">Unapprove</a></td>
      <td><a href="posts.php?source=edit_post&id=<?php echo $post_id; ?>">Edit</a></td>
      <td><a href="includes/admin_posts_actions.php?action=delete&id=<?php echo $post_id; ?>" onclick='return confirm("Are you sure you want to delete the post ?")'>Delete</a></td>
    </tr>
    <?php 
  }
}


function show_posts_by_author(){
  global $connection;
  $author_name = $_SESSION['user']['user_name'];
  $query = "SELECT * FROM posts WHERE post_author = '$author_name'";
  $result = mysqli_query($connection,$query);
  if(mysqli_num_rows($result)){
  while($row = mysqli_fetch_assoc($result)){
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


    //Show only an exerpt of the content
    $post_content = substr($post_content,0,20).'..';
    ?>
    <tr id="title_row">
      <td><input type="checkbox" class="checkboxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
      <td><?php echo $post_id; ?></td>
      <td id="title"><a href="../single_post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a></td>
      <td><?php echo $post_category; ?></td>
      <td><?php echo $post_author; ?></td>
      <td><?php echo $post_date; ?></td>
      <td><img src="images/<?php echo $post_image; ?>" alt="" class="img-responsive" style="width:150px;"></td>
      <td><?php echo $post_comment_count; ?></td>
      <td><?php echo $post_views; ?></td>
      <td><?php echo $post_tags; ?></td>
      <td><?php echo $post_status; ?></td>
      <td><a href="includes/admin_posts_actions.php?action=approve&id=<?php echo $post_id; ?>">Approve</a></td>
      <td><a href="includes/admin_posts_actions.php?action=unapprove&id=<?php echo $post_id; ?>">Unapprove</a></td>
      <td><a href="posts.php?source=edit_post&id=<?php echo $post_id; ?>">Edit</a></td>
      <td><a href="includes/admin_posts_actions.php?action=delete&id=<?php echo $post_id; ?>" onclick='return confirm("Are you sure you want to delete the post ?")'>Delete</a></td>
    </tr>
    <?php 
  }
}
}



























//--------------------------------Comments---------------------------------------------

function unapprove($id){
  global $connection;

  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../comment.php");
  }
}

function approve($id){
  global $connection;

  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../comment.php");
  }
}

function delete_comment($id){
  global $connection;

 
  //Decrease comment count

  $get_post_id = mysqli_query($connection,"SELECT comment_post_id FROM comments WHERE comment_id = '$id' ");
  if($get_post_id){
    $row=mysqli_fetch_assoc($get_post_id);
    $pid = $row['comment_post_id'];

    $decrease_query = mysqli_query($connection,"UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = '$pid'");
    if(!$decrease_query){
      die("Query Failed ".mysqli_error($connection));
    }
  }else{
    die("Query Failed ".mysqli_error($connection));
  }

  $query = "DELETE FROM comments WHERE comment_id = '$id'";
  $result = mysqli_query($connection,$query);

  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../comment.php");
  }
}



function getCount($item){
  global $connection;
  $query = mysqli_query($connection,"SELECT * FROM $item");
  $count = mysqli_num_rows($query);
  return $count;
}


//----------------------------------Posts--------------------------------------------------------------------------

function unapprove_post($id){
  global $connection;

  $query = "UPDATE posts SET post_status = 'draft' WHERE post_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../posts.php?source=view_all_posts");
  }
}
function approve_post($id){
  global $connection;

  $query = "UPDATE posts SET post_status = 'published' WHERE post_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../posts.php?source=view_all_posts");
  }
}



function edit_post(){
  global $connection;
  if(isset($_POST['edit'])){
    $post_id = $_POST['id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category = $_POST['category'];
    $post_content = $_POST['content'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];
    $post_date = date("l d F Y");
    $post_image = $_FILES['image']['name'];
    //File Upload Section
    if(!empty($post_image))
    {
    $target_dir = "images/";
    $target_file = $_SERVER['DOCUMENT_ROOT'].'/blogging_system/admin/'.$target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
      }

    $post_image_name = $_FILES['image']['name'];
    //Inserting into database
    $query = "UPDATE posts SET post_title='$post_title',post_category='$post_category',post_author='$post_author',post_content='$post_content',post_date='$post_date',post_image='$post_image_name',post_tags='$post_tags',post_status='$post_status' WHERE post_id = '$post_id'";

    $exec = mysqli_query($connection,$query);
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
    }else{
      header("Location:../posts.php?source=edit_post&id={$post_id}&msg=edit_success");    }

  }
}else{
  //If the image is not changed
        $query = "select * from posts where post_id = '$post_id'";
        $select_image_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_image_query))
        {
            $post_image = $row['post_image'];
        }
    $query = "UPDATE posts SET post_title='$post_title',post_category='$post_category',post_author='$post_author',post_content='$post_content',post_date='$post_date',post_image='$post_image',post_tags='$post_tags',post_status='$post_status' WHERE post_id = '$post_id'";

    $exec = mysqli_query($connection,$query);
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
    }else{
      echo "NO change";
      header("Location:../posts.php?source=edit_post&id={$post_id}&msg=edit_success");
      // header("Location:../../single_post.php?post_id={$post_id}");
    }
  
    }
  }
}

edit_post();

function delete_post($id){
  global $connection;
  $delete = mysqli_query($connection,"DELETE FROM posts WHERE post_id = '$id'");
  if(!$delete){
    die("Query Failed ".mysqli_error($connection));
  }
  //After deleting the post delete the comments associated with it
  $query = "DELETE FROM comments WHERE comment_post_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$query){
    die("Query Failed ".mysqli_error($connection));
  }
  header("Location:../posts.php?source=view_all_posts&msg=Post Deleted");
}

//--------------------------------Users-----------------------------------------------------


function view_users(){
  global $connection;
  $query = "SELECT * FROM users";
  $result = mysqli_query($connection,$query);
  while($row = mysqli_fetch_assoc($result)){
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_pic = $row['user_pic'];
    $user_role = $row['user_role'];
    ?>
    <tr>
      <td><?php echo $user_id; ?></td>
      <td><?php echo $user_name; ?></td>
      <td><?php echo $user_email; ?></td>
      <td><img src="user_images/<?php echo $user_pic; ?>" alt="" class="img-responsive" style="width:100px; height:70px;"></td>
      <td><?php echo $user_role; ?></td>
      <td><a  href="users.php?source=edit_user&id=<?php echo $user_id; ?>">Edit</a></td>
      <td><a href="includes/admin_users_actions.php?action=make_subscriber&id=<?php echo $user_id ?>">Make Subs</a></td>
      <td><a  href="includes/admin_users_actions.php?action=make_admin&id=<?php echo $user_id ?>">Make Admin</a></td>
      <td><a href="includes/admin_users_actions.php?action=delete_user&id=<?php echo $user_id ?>" onclick='return confirm("Are you sure you want to delete the post ?")'>Delete</a></td>
    </tr>
    <?php 
  }
}


function make_admin($id){
  global $connection;

  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../users.php?source=view_all_users");
  }
}

function make_subscriber($id){
  global $connection;

  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '$id'";
  $result = mysqli_query($connection,$query);
  if(!$result){
    die("Query Failed ".mysqli_error($connection));
  }else{
    header("Location:../users.php?source=view_all_users");
  }
}


function delete_user($id){
  global $connection;
  $delete = mysqli_query($connection,"DELETE FROM users WHERE user_id = '$id'");
  if(!$delete){
    die("Query Failed ".mysqli_error($connection));
  }
  
  header("Location:../users.php?source=view_all_users&msg=User Deleted");
}


function add_user(){
  global $connection;
  if(isset($_POST['add_user'])){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pic = $_POST['user_image'];
    $user_role = $_POST['user_role'];
    $user_password = $_POST['user_password'];

    //Check if there is profile picture of the user
    if(isset($_POST['user_image'])){
        //File Upload Section
        $target_dir = "user_images/";
        $target_file = $_SERVER['DOCUMENT_ROOT'].'/blogging_system/admin/'.$target_dir . basename($_FILES["user_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["user_image"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
          }

        $user_image_name = $_FILES['user_image']['name'];
        //Inserting into database
        $query = "INSERT INTO users (user_name,user_email,user_password,user_role,user_pic) VALUES ('$user_name','$user_email','$user_password','$user_role','$user_image_name')";
      }
    }else{
      //If there is no profile picture of the user then set profile picture to default profile picture

      $user_image = 'default.jpg';
      //Inserting into database
      $query = "INSERT INTO users (user_name,user_email,user_password,user_role,user_pic) VALUES ('$user_name','$user_email','$user_password','$user_role','$user_image')";
    }
    $exec = mysqli_query($connection,$query);
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
    }else{
      header("Location:../users.php?source=view_all_users");
    }
    
}
}

add_user();





function edit_user(){
  global $connection;
  if(isset($_POST['edit_user'])){
    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pic = $_POST['user_image'];
    $user_role = $_POST['user_role'];
    $user_password = $_POST['user_password'];
    $user_image = $_FILES['user_image']['name'];
    //File Upload Section
    if(!empty($user_image))
    {
    $target_dir = "user_images/";
    $target_file = $_SERVER['DOCUMENT_ROOT'].'/blogging_system/admin/'.$target_dir . basename($_FILES["user_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check file size
    if ($_FILES["user_image"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }

    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (!move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
        echo "Sorry, there was an error uploading your file.";
      }

    $user_image_name = $_FILES['user_image']['name'];
    //Inserting into database
    $query = "UPDATE users SET user_name='$user_name',user_email='$user_email',user_password='$user_password',user_role='$user_role',user_pic='$user_image_name' WHERE user_id = '$user_id'";

     //If an admin changes his own details then update the session also
     if($user_id == $_SESSION['user']['user_id']){
      $_SESSION['user']['user_name'] = $user_name;
      $_SESSION['user']['user_email'] = $user_email;
      $_SESSION['user']['user_pic'] = $user_pic;
      $_SESSION['user']['user_password'] =$user_password;
    }

    $exec = mysqli_query($connection,$query);
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
    }else{
      header("Location:../users.php?source=edit_user&id={$user_id}&msg=edit_success");    
    }

  }
}else{
  //If the image is not changed
        $query = "select * from users where user_id = '$user_id'";
        $select_image_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_image_query))
        {
            $post_image = $row['user_pic'];
        }
    $query = "UPDATE users SET user_name='$user_name',user_email='$user_email',user_password='$user_password',user_role='$user_role',user_pic='$post_image' WHERE user_id = '$user_id'";

    $exec = mysqli_query($connection,$query);
     //If an admin changes his own details then update the session also
     if($user_id == $_SESSION['user']['user_id']){
      $_SESSION['user']['user_name'] = $user_name;
      $_SESSION['user']['user_email'] = $user_email;
      $_SESSION['user']['user_password'] =$user_password;
    }
    if(!$query){
      die("Query Failed ".mysqli_error($connection));
    }else{
      header("Location:../users.php?source=edit_user&id={$user_id}&msg=edit_success");
      // header("Location:../../single_post.php?post_id={$post_id}");
    }
  
    }
  }
}

edit_user();


?>