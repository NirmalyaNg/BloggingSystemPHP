<!--Start Navigation header-->
<header role="banner">
        <div class="top-bar">
          <div class="container">
            <div class="row">
              <div class="col-9 social">
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-instagram"></span></a>
                <a href="#"><span class="fa fa-youtube-play"></span></a>
              </div>
              <div class="col-3 search-top">
                <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                <form action="search.php" class="search-top-form" method="post">
                  <span class="icon fa fa-search"></span>
                  <input type="text" id="s" name="search" placeholder="Type keyword to search...">
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="container logo-wrap">
          <div class="row pt-5">
            <div class="col-12 text-center">
              <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
              <h1 class="site-logo"><a href="index.html">Blogsforu</a></h1>
            </div>
          </div>
        </div>
        
        <nav class="navbar navbar-expand-md  navbar-light bg-light">
          <div class="container">
            
           
            <div class="collapse navbar-collapse" id="navbarMenu">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <?php
                    if(isset($title)){
                      ?>
                        <a class="nav-link" href="index.php">Home</a>
                      <?php
                    }else{
                      ?>
                        <a class="nav-link active" href="index.php">Home</a>
                      <?php
                    }
                  ?>
                </li>
                <?php 
                   $query = "SELECT * FROM categories LIMIT 4";
                   $result = mysqli_query($connection,$query);
                 
                   while($row = mysqli_fetch_assoc($result)){
                     $cat_id = $row['cat_id'];
                     $cat_title = $row['cat_title'];
                     if(isset($title)){
                     if($cat_title == $title){
                       echo "<li class='nav-item'>
                       <a class='nav-link active' href='category_posts.php?cat_id={$cat_id}'>{$cat_title}</a>
                     </li> ";
                     }else{
                       echo "<li class='nav-item'>
                     <a class='nav-link' href='category_posts.php?cat_id={$cat_id}'>{$cat_title}</a>
                   </li> ";
                     }
                    }else{
                      echo "<li class='nav-item'>
                      <a class='nav-link' href='category_posts.php?cat_id={$cat_id}'>{$cat_title}</a>
                    </li> ";
                    }
                  }
                ?>                          
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact</a>
                </li>
              </ul>
              
            </div>
          </div>
        </nav>
      </header>
      <!-- END header -->
