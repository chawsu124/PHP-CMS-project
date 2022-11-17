<!-- search -->
<div class="well">
    <h4>Blog Search</h4>
    <form action="search.php" method = "post">
        <div class="input-group">
            <input type="text" name = "post_tag" class="form-control">
            <span class="input-group-btn">
                <button type="submit" name = "search" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </form>    
</div>
<!--/ search -->

<!-- Login Form -->
<div class="well">
    <h3>Login-Form</h3>
    <legend></legend>
    <form action="include_user/login.php" method = "post">
        <div class="form-group">
            <input type="text" name = "username" placeholder = "Please Enter Your Name" class = "form-control">
        </div>
        <div class="input-group">
                <input type="password" name = "password" placeholder = "Please Enter Your Password" class = "form-control">
                <span class="input-group-btn">
                    <button type="submit" name = "login" class="btn btn-primary" >
                        Login
                    </button>
                </span>
        </div>
    </form>
</div>

                <!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
                <?php
                    $sql = "SELECT * FROM categories ORDER BY cat_id DESC";
                    $result = mysqli_query($con,$sql);
                    confirm_query($result);

                    while($row = mysqli_fetch_assoc($result)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                    
                ?>
                    <li>
                        <a href="post_category.php?cat_id=<?php echo $cat_id ?>"><?php echo $cat_title ?></a>
                    </li>
                <?php
                    }
                ?>
            </ul>
        </div>
                       
    </div>
                    <!-- /.row -->
</div>

<div class="well">
    <h4>Side Widget Well</h4>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
        
                <?php
                        // show all posts from database
                        $sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT 0,5";
                        $result = mysqli_query($con,$sql);

                        confirm_query($result);

                        while($row = mysqli_fetch_assoc($result)){
                            $post_id = escape($row['post_id']);
                            $post_title = escape($row['post_title']);
                            $post_image = basename($row['post_image']);
                            $post_content = escape($row['post_content']);
                            ?>
                            <a href="post.php?p_id=<?php echo $post_id; ?>">
                                <p class = "lead"><?php echo $post_title; ?></p>
                            </a>
                            <img src="images/<?php echo $post_image; ?>" alt="" width = "100px">
                            <p>
                                <?php 
                                    echo substr($post_content,0,20); 
                                    echo strlen($post_content) > 20 ? "...." : "";
                                ?>
                            </p>
                        <?php 
                        } 
                        ?>    
            </div>
        </div>
    </div>
</div>
