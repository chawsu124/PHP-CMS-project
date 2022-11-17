<?php
    // checkbox
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $p_id){
            $bulk_option = $_POST['bulk_option'];

            if(empty($bulk_option)){
                break;
            }

            switch($bulk_option){
                case "clone" : // clone selected posts and show all in Table form 
                    $sql = "SELECT * FROM post WHERE post_id = $p_id";
                    $select_post = mysqli_query($con,$sql);

                    confirm_query($select_post);

                    while($row = mysqli_fetch_assoc($select_post)){
                        $post_category = escape($row['post_category_id']);
                        $post_title = escape($row['post_title']);
                        $post_author = escape($row['post_author']);

                        $post_image = basename($row['post_image']);

                        $post_tag = escape($row['post_tag']);
                        $post_content = escape($row['post_content']);
                        $post_status = escape($row['post_status']);

                        $sql = "INSERT INTO post(post_category_id,post_title, post_author, post_date, post_image, post_tag, post_content,post_status)
                                VALUES ($post_category,'$post_title','$post_author',now(),'$post_image','$post_tag','$post_content','$post_status')";

                        $insert_post = mysqli_query($con,$sql);
                        confirm_query($insert_post);
                    }
                break; 
                
                case "delete" : // delete selected posts
                    $sql = "DELETE FROM post WHERE post_id = $p_id";
                    $delete_post = mysqli_query($con,$sql);

                    confirm_query($delete_post);
                break;
                
                case 'publish':
                    $sql ="UPDATE post SET post_status='publish' WHERE post_id=$p_id";
                    confirm_query(mysqli_query($con,$sql));
                break;
                
                case 'draft':
                    $sql ="UPDATE post SET post_status='draft' WHERE post_id=$p_id";
                    confirm_query(mysqli_query($con,$sql));
                break;
            }
        }
    }
?>

<form action="" method = "post">

    <div class="col-md-2">
        <div class="form-group">
            <select name="bulk_option" id="" class = "form-control">
                <option value="">--Select Option--</option>
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
    </div>
    <div class="col-md-10">
        <input type="submit" name = "submit" value = "Apply" class = "btn btn-primary">
    </div>

    <table class = "table table-bordered">
        <tr>
            <th><input type="checkbox" class = "checkAllBox"></th>
            <th>ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Author</th>
            <th>Image</th>
            <th>Date</th>
            <th>Tag</th>
            <th>PostCount</th>
            <th>CommentCount</th>
            <th>Status</th>
            <th>View Post</th>
        </tr>

        <?php
            // show all posts in Table form 
            $sql = "SELECT * FROM post ORDER BY post_id DESC";
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
                $post_view_count = escape($row['post_view_count']);
                // $post_content = escape($row['post_content']);
                $post_status = escape($row['post_status']);
                
                ?>

                <tr>
                    <td>
                        <input type="checkbox" name = "checkBoxArray[]"
                            value = "<?php echo $post_id ?>" class = "checkBoxes">
                    </td>
                    <td><?php echo $post_id; ?></td>
                    <td>
                        <?php 
                            $sql = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                            $select_post_category = mysqli_query($con,$sql);
                            confirm_query($select_post_category);
                            $row = mysqli_fetch_assoc($select_post_category);
                            echo $row['cat_title'];
                        ?>
                    </td>
                    <td><?php echo $post_title; ?></td>
                    <td><?php echo $post_author; ?></td>
                    <td><img src="../images/<?php echo $post_image; ?>" alt="" width = "100px"></td>
                    <td><?php echo $post_date; ?></td>
                    <td><?php echo $post_tag; ?></td>
                    <!-- <td>
                        <?php
                            // echo substr($post_content,0,50);
                            // echo strlen($post_content) > 50 ? "....." : "";
                        ?>
                    </td> -->
                    <td><a href="post.php?reset=<?php echo $post_id ?>"><?php echo $post_view_count; ?></a></td>
                    <td>
                        <?php 
                            $comment_count_query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                            $comment_count_result = mysqli_query($con,$comment_count_query);
                            $comment_count = mysqli_num_rows($comment_count_result); // how much comment this post id

                            echo $comment_count;
                        ?>
                    </td>
                    <td><?php echo $post_status; ?></td>
                    <td><a href="../post.php?p_id=<?php echo $post_id; ?>">View Post</a></td>
                    <td>
                        <a href="post.php?source=edit_post&p_id=<?php echo $post_id ?>">Edit</a>
                    </td>
                    <td>
                        <a class = "delete_post" href="post.php?delete=<?php echo $post_id ?>">Delete</a>
                    </td>
                </tr>

                <?php
            }
        ?>
    </table>
</form>


    <?php
        // Delete Post 
        if(isset($_GET['delete'])){
            $p_id = $_GET['delete'];
            $sql = "DELETE FROM post WHERE post_id = $p_id";
            $result = mysqli_query($con,$sql);

            confirm_query($result);

            header('Location: post.php');
           
        }

        // Reset Post view count
        if(isset($_GET['reset'])){
            $reset_id = $_GET['reset'];
            $sql = "UPDATE post SET post_view_count = 0 WHERE post_id = $reset_id";
            $result = mysqli_query($con,$sql);

            confirm_query($result);

            header('Location: post.php');
           
        }
    ?>