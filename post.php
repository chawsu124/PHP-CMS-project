<?php
    include_once "include_user/header_user.php";
?>
    <!-- Navigation -->
    <?php
        include_once "include_user/nav_user.php";
    ?>
    <?php // increate post view count
        if(isset($_GET['p_id'])){
            $p_id = $_GET['p_id'];

            $post_count_query = "UPDATE post SET post_view_count = post_view_count + 1 WHERE post_id = $p_id";
            $post_count = mysqli_query($con,$post_count_query);
            confirm_query($post_count);
    ?>
        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Blog Post -->
                    <?php
                    // show posts which is click post_id from Database
                    $sql = "SELECT * FROM post WHERE post_id = $p_id";
                    $result = mysqli_query($con,$sql);

                    confirm_query($result);

                    while($row = mysqli_fetch_assoc($result)){
                        $post_id = escape($row['post_id']);
                        $post_category_id = escape($row['post_category_id']);
                        $post_title = escape($row['post_title']);
                        $post_author = escape($row['post_author']);
                        $post_image = basename($row['post_image']);
                        $post_date = escape($row['post_date']);
                        $post_tag = escape($row['post_tag']);
                        $post_content = escape($row['post_content']);
                    
                        ?>

                        <!-- Title -->
                        <h1><?php echo $post_title; ?></h1>

                        <!-- Author -->
                        <p class="lead">
                            by <?php echo $post_author; ?>
                        </p>

                        <hr>

                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>

                        <hr>

                        <!-- Preview Image -->
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                        <hr>

                        <!-- Post Content -->
                        <p class="lead">
                            <?php echo $post_content; ?>
                        </p>
                        
                        <hr>
                    <?php
                        }
                    ?>

                    <!-- Blog Comments -->
                    <?php
                        if(isset($_POST['create_comment'])){
                            $comment_author = clean_input($_POST['comment_author']);
                            $comment_email = clean_input($_POST['comment_email']);
                            $comment_content = clean_input($_POST['comment_content']);

                            if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                                $sql = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date) 
                                        VALUES($p_id,'$comment_author','$comment_email','$comment_content',now())";
                                confirm_query(mysqli_query($con,$sql));
                                echo "Your comment is success. Please wait for approved.";
                            }else{
                                echo "<script>alert('Please Enter all blank');</script>";
                            }
                        }
                    ?>
                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" method = "post">
                            <div class="form-group">
                                <label for="" class = "control-label">User Name</label>
                                <input type="text" name = "comment_author" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class = "control-label">User Email</label>
                                <input type="text" name = "comment_email" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class = "control-label">Please Enter your comment</label>
                                <textarea name = "comment_content" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name = "create_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->
                    <?php // show comment on post
                        $comment_post_id = $p_id;
                        $sql = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id
                                AND comment_status = 'approved'";
                        $result = mysqli_query($con,$sql);
                        confirm_query($result);

                        while($row = mysqli_fetch_assoc($result)){
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];

                            
                            ?>

                            <!-- Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author; ?>
                                        <small><?php echo $comment_date; ?></small>
                                    </h4>
                                    <?php echo $comment_content; ?>
                                </div>
                            </div>
                            <?php
                        }
                    ?>    
                    
                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-md-4">
                    <?php include_once "include_user/sidebar_user.php"; ?>
                </div>

        </div>
        <!-- /.row -->
    <?php
        }else{
            redirect("index.php");
        }
    ?>

<?php include_once "include_user/footer_user.php";  ?>