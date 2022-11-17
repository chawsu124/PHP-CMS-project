<?php
    // Create Post
    if(isset($_POST['create_post'])){
        $post_category_id = escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);
        $post_title = escape($_POST['post_title']);
        $post_author = escape($_POST['post_author']);

        $post_image = basename($_FILES['post_image']['name']);
        $post_image_tmp = $_FILES['post_image']['tmp_name'];


        $post_tag = escape($_POST['post_tag']);
        $post_content = escape($_POST['post_content']);

        move_uploaded_file($post_image_tmp,'../images/' . $post_image);

        $sql = "INSERT INTO post(post_category_id,post_title, post_author, post_date, post_image, post_tag, post_content,post_status)
                 VALUES ($post_category_id,'$post_title','$post_author',now(),'$post_image','$post_tag','$post_content','$post_status')";

        $result = mysqli_query($con,$sql);
        confirm_query($result);
        echo "<p>Post Created</p>";        
    }
?>

<h3>Add New Post</h3>
<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for="" class = "control-label">Select Category</label>
        <select name="post_category_id" id="" class = "form-control">
            <?php
                $sql = "SELECT * FROM categories";
                $select_cat = mysqli_query($con,$sql);
                confirm_query($select_cat);

                while($row = mysqli_fetch_assoc($select_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
            ?>
                    <option value="<?php echo $cat_id ?>">
                        <?php echo $cat_title ?>
                    </option>
            <?php
                }
            ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="" class = "control-label">Status</label>
        <select name="post_status" class = "form-control" id="">
            <option value="draft">Select Option</option>
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
        </select>
        
    </div>
    <div class="form-group">
        <label for="post_title" class = "control-label">Post_Title</label>
        <input type="text" name = "post_title" class = "form-control">
    </div>
    <div class="form-group">
        <label for="post_author" class = "control-label">Post_Author</label>
        <select name="post_author" id="" class = "form-control">
            <?php
                $sql = "SELECT * FROM users WHERE user_role = 'admin'";
                $select_user = mysqli_query($con,$sql);
                confirm_query($select_user);

                while($row = mysqli_fetch_assoc($select_user)){
                    $user_id = $row['user_id'];
                    $username = $row['username'];
            ?>
                    <option value="<?php echo $user_id ?>">
                        <?php echo $username ?>
                    </option>
            <?php
                }
            ?>   
        </select>
    </div>
    <div class="form-group">
        <label for="post_image" class = "control-label">Post_Image</label>
        <input type="file" name = "post_image" >
    </div>
    <div class="form-group">
        <label for="post_tag" class = "control-label">Post_Tag</label>
        <input type="text" name = "post_tag" class = "form-control">
    </div>
    <div class="form-group">
        <label for="post_content" class = "control-label">Post_Content</label>
        <textarea name = "post_content" cols = "30" rows = "10" class = "form-control"></textarea>
    </div>
    <input type="submit" name = "create_post" value = "Create Post" class = "btn btn-primary">
</form>
<!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias dicta quas voluptatem ullam ipsa! Eveniet inventore debitis laboriosam perspiciatis! Impedit nemo deleniti sapiente veniam est quidem reiciendis expedita at dolores? -->