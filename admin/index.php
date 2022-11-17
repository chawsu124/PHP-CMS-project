<?php
    include_once "include_admin/admin_header.php";
?>

    <?php // user_online get from session
        $session = session_id(); // built-in session_id get function
        $time = time();
        // echo $session;
        $session_user_time_out = 60;
        $time_out = $time - $session_user_time_out;

         $query = "SELECT * FROM user_online WHERE session = '$session'";
         $result = mysqli_query($con,$query);
        $user_count = mysqli_num_rows($result);

        if($user_count == null){
            mysqli_query($con,"INSERT INTO user_online(session,time) VALUES('$session',$time)");
        }else{
            mysqli_query($con,"UPDATE user_online SET session = '$session', time = $time WHERE session = '$session'");
        }

        $user_online_query = mysqli_query($con,"SELECT * FROM user_online WHERE time > $time_out");

        $user_online_count = mysqli_num_rows($user_online_query);
    ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
            include_once "include_admin/admin_nav.php";
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>
                                <?php 
                                    echo $_SESSION['username']; 
                                    echo $user_online_count;
                                ?>
                            </small>
                        </h1>    
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "SELECT * FROM post";
                                            $result = mysqli_query($con,$sql);
                                            confirm_query($result);

                                            $post_count = mysqli_num_rows($result);
                                            echo "<div class='huge'>{$post_count}</div>";
                                        ?>
                                        
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="post.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                        <?php
                                            $sql = "SELECT * FROM comments";
                                            $result = mysqli_query($con,$sql);
                                            confirm_query($result);

                                            $comment_count = mysqli_num_rows($result);
                                            echo "<div class='huge'>{$comment_count}</div>";
                                        ?>
                                        
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comment.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "SELECT * FROM users";
                                            $result = mysqli_query($con,$sql);
                                            confirm_query($result);

                                            $user_count = mysqli_num_rows($result);
                                            echo "<div class='huge'>{$user_count}</div>";
                                        ?>
                                    
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="allusers.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php
                                            $sql = "SELECT * FROM categories";
                                            $result = mysqli_query($con,$sql);
                                            confirm_query($result);

                                            $category_count = mysqli_num_rows($result);
                                            echo "<div class='huge'>{$category_count}</div>";
                                        ?>
                                        
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="admin_categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    
</body>

</html>