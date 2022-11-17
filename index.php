<?php
    include_once "include_user/header_user.php";
?>
    <!-- Navigation -->
    <?php
        include_once "include_user/nav_user.php";
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                    // if (user click page number 1/2/3/4/5/6/7) or (no page click start in website)
                    // get page number from click
                    $per_page = 5; // 5 posts show each page number 

                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = "";
                    }

                    // check start page from user click page number
                    if($page == "" || $page == 1){
                        $start_page = 0;
                    }else{
                        $start_page = ($page * 5) - 5;
                    }


                    // show all post count from database
                    $post_count_query = "SELECT * FROM post WHERE post_status = 'publish'";
                    $fine_count = mysqli_query($con,$post_count_query);
                    $count = mysqli_num_rows($fine_count);

                    $count = ceil($count/5);

                    // show all posts from Database
                    $sql = "SELECT * FROM post WHERE post_status = 'publish' 
                            LIMIT $start_page,$per_page";
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

                        <!-- Blog Post -->
                        <!-- <h2><?php //echo $count; ?></h2> -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
                        <hr>
                        <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" width = "500px" alt="">
                        </a>
                        <hr>
                        <p>
                            <?php 
                                echo substr($post_content,0,50);
                                echo strlen($post_content) > 50 ? '....' : '';
                            ?>
                        </p>
                        <a href="post.php?p_id=<?php echo $post_id; ?>" class="btn btn-primary" >
                            Read More <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>

                        <hr>

                    <?php 
                    }
                    ?>

                <!-- Pager -->
                <ul class="pager">
                    <?php
                        for($i = 1;$i <= $count;$i++){
                            if($i == $page){
                                echo "<li class='active_link'><a href='index.php?page=$i'>$i</a></li>";
                            }else{
                                echo "<li><a href='index.php?page=$i'>$i</a></li>";
                            }   
                        }
                    ?>
                    
                </ul>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <?php
                    include_once "include_user/sidebar_user.php";
                ?>
                
            </div>

        </div>
        <!-- /.row -->

        <?php
            include_once "include_user/footer_user.php";
        ?> 