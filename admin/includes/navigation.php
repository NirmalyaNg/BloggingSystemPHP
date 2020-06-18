

 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav" style="margin-left:-10px;">
                  <li><a href="../index.php">Visit Site</a></li>

                  <li><a href="profile.php"><i class="fa fa-user"></i> <?php echo $_SESSION['user']['user_name']; ?></a></li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
            </ul>
             <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if(isset($index_page) && $index_page == 'index.php') {echo 'class='.'active' ;} ?>>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li <?php if(isset($posts_page) && $posts_page == 'posts.php') {echo 'class='.'active' ;} ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-send"></i> Posts  <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="posts.php?source=view_all_posts">View Posts</a>
                            </li>
                            <li>
                                <a href="posts.php?source=add_new">Add New Posts</a>
                            </li>

                        </ul>
                    </li>
                       <li <?php if(isset($categories_page) && $categories_page == 'categories.php') {echo 'class='.'active' ;} ?>>
                        <a href="categories.php"><i class="fa fa-fw fa-suitcase"></i> Categories</a>
                    </li>
                    <li <?php if(isset($comments_page) && $comments_page == 'comments.php') {echo 'class='.'active' ;} ?>>
                        <a href="comment.php"><i class="fa fa-fw fa-comment"></i> Comments </a>
                    </li>
                       <li <?php if(isset($users_page) && $users_page == 'users.php') {echo 'class='.'active' ;} ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="users" class="collapse">
                            <li>

                                <a href="users.php?source=view_all_users">View All Users</a>
                            </li>
                            <li>
                                <a href="users.php?source=add_user">Add New Users</a>
                            </li>

                        </ul>
                    </li>
                    <li <?php if(isset($profile_page) && $profile_page == 'profile.php') {echo 'class='.'active' ;} ?>>
                        <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
