<?php

class Comment{
  private $connection;
  
  public function __construct($conn){
    $this->connection = $conn;
  }
  
  public function add_comment($post_id,$name,$email,$body){

    if(!empty($body) && !empty($name)){
      $date = date("l d F Y");
      $query = mysqli_query($this->connection,"INSERT INTO comments (comment_post_id,comment_name,comment_email,comment_body,comment_date,comment_status) VALUES('$post_id','$name','$email','$body','$date','unapproved')");
      if(!$query){
        die("Query Failed ".mysqli_error($this->connection));
      }

      // //Increase comment count
      $query1 = mysqli_query($this->connection,"UPDATE posts SET post_comment_count = (post_comment_count + 1) WHERE post_id = '$post_id'");
      if(!$query1){
        die("Query Failed ".mysqli_error($this->connection));
      }
      
    }else{
      return false;
    }
  }


  public function getApprovedComments($post_id){  
    $id = $post_id;
    $result2 = mysqli_query($this->connection,"SELECT * FROM comments WHERE comment_post_id = '$id' AND comment_status = 'approved'");
    if(!$result2){
      die("Query Failed ".mysqli_error($this->connection));
    }
    if(mysqli_num_rows($result2) === 0){
      echo "<p class='lead'>No Comments for this post.</p>";
    }else{
      while($row=mysqli_fetch_assoc($result2)){
        $comment_id = $row['comment_id'];
        $comment_name = $row['comment_name'];
        $comment_email = $row['comment_email'];
        $comment_body = $row['comment_body'];
        $comment_date = $row['comment_date'];
      
        echo "<li class='comment'>
            <div class='vcard'>
              <img src='images/person_2.jpg' alt='Image placeholder'>
            </div>
            <div class='comment-body'>
              <h3>{$comment_name}</h3>
              <div class='meta'>{$comment_date}</div>
                <p>{$comment_body}</p>
            </div>
          </li>";
      
      }
    }
  }




  public function getCommentCount($post_id){
    $id = $post_id;
    $count_query = mysqli_query($this->connection,"SELECT * FROM comments WHERE comment_status = 'approved' AND comment_post_id='$id'");
    if(!$count_query){
      die("Query Failed ".mysqli_error($this->connection));
    }
    return mysqli_num_rows($count_query);
  }



  public function getCommentsInAdminTable(){
    $query = mysqli_query($this->connection,"SELECT * FROM comments ORDER BY comment_id DESC");
    if($query){
      while($row = mysqli_fetch_assoc($query)){
        $comment_id = $row['comment_id'];
        $comment_name = $row['comment_name'];
        $comment_email = $row['comment_email'];
        $comment_body = $row['comment_body'];
        $comment_status = $row['comment_status'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];


        //get the post title from comment_post_id
        $confirm_msg = 'Are you sure you want to delete this comment ?';
        $get_post_title = mysqli_query($this->connection,"SELECT post_title FROM posts WHERE post_id = '$comment_post_id'");
        $row2 = mysqli_fetch_assoc($get_post_title);
        $post_title = $row2['post_title']; 

        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td><a href='../single_post.php?post_id={$comment_post_id}'>{$post_title}</a></td>";
        echo "<td>{$comment_name}</td>";
        echo "<td>{$comment_email}</td>";
        echo "<td>{$comment_body}</td>";
        echo "<td>{$comment_date}</td>";
        echo "<td>{$comment_status}</td>";
        echo "<td>{$comment_post_id}</td>";
        echo "<td><a href='includes/admin_comment_actions.php?action=approve&id={$comment_id}' style='text-decoration:none;'>Approve</a></td>";
        echo "<td><a href='includes/admin_comment_actions.php?action=unapprove&id={$comment_id}' style='text-decoration:none;'>Unapprove</a></td>"; ?>
        <td><a href='includes/admin_comment_actions.php?action=delete&id=<?php echo $comment_id; ?>' onclick='return confirm("Are you sure you want to delete this comment ?")' style='text-decoration:none;'>Delete</a></td>
        <?php echo "</tr>";
      }
    }
  }

  public function getAuthorPostComments(){
    $query = mysqli_query($this->connection,"SELECT * FROM comments ORDER BY comment_id DESC");
    if($query){
      while($row = mysqli_fetch_assoc($query)){
        $comment_id = $row['comment_id'];
        $comment_name = $row['comment_name'];
        $comment_email = $row['comment_email'];
        $comment_body = $row['comment_body'];
        $comment_status = $row['comment_status'];
        $comment_post_id = $row['comment_post_id'];
        $comment_date = $row['comment_date'];
        //Check whether the comment is for the post related to the author loggen in
        $result1 = mysqli_query($this->connection,"SELECT post_author FROM posts WHERE post_id = '$comment_post_id' ");
        $row1 = mysqli_fetch_assoc($result1);
        $author_name = $row1['post_author'];
        if($author_name === $_SESSION['user']['user_name']){
          //get the post title from comment_post_id
          $get_post_title = mysqli_query($this->connection,"SELECT post_title FROM posts WHERE post_id = '$comment_post_id'");
          $row2 = mysqli_fetch_assoc($get_post_title);
          $post_title = $row2['post_title']; 

          echo "<tr>";
          echo "<td>{$comment_id}</td>";
          echo "<td><a href='../single_post.php?post_id={$comment_post_id}'>{$post_title}</a></td>";
          echo "<td>{$comment_name}</td>";
          echo "<td>{$comment_email}</td>";
          echo "<td>{$comment_body}</td>";
          echo "<td>{$comment_date}</td>";
          echo "<td>{$comment_status}</td>";
          echo "<td>{$comment_post_id}</td>";
          echo "<td><a href='includes/admin_comment_actions.php?action=approve&id={$comment_id}' style='text-decoration:none;'>Approve</a></td>";
          echo "<td><a href='includes/admin_comment_actions.php?action=unapprove&id={$comment_id}' style='text-decoration:none;'>Unapprove</a></td>"; ?>
          <td><a href='includes/admin_comment_actions.php?action=delete&id=<?php echo $comment_id; ?>' onclick='return confirm("Are you sure you want to delete this comment ?")' style='text-decoration:none;'>Delete</a></td>
          <?php echo "</tr>";
        }

       
      }
    }
  }









}

?>