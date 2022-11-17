<?php
    // Edit Post from edit btn in Table form
    if(isset($_GET['p_id'])){
        $p_id = (int)$_GET['p_id'];
    }else {
        redirect("post.php");
    }
    // if you click edit btn,
    // show this post data from post_id

    $sql = "SELECT * FROM post WHERE post_id = $p_id";
    $select_post = mysqli_query($con,$sql);

    confirm_query($select_post);

    while($row = mysqli_fetch_assoc($select_post)){
        $post_title = escape($row['post_title']);
        $post_category_id = escape($row['post_category_id']);
        $post_status = escape($row['post_status']);
        $post_author = escape($row['post_author']);

        $post_image = basename($row['post_image']);

        $post_tag = escape($row['post_tag']);
        $post_content = escape($row['post_content']);

        // $sql = "INSERT INTO post(post_title, post_author, post_date, post_image, post_tag, post_content)
        //                         VALUES ('$post_title','$post_author',now(),'$post_image','$post_tag','$post_content')";

        // $insert_post = mysqli_query($con,$sql);
        // confirm_query($insert_post);

    }

?>

<form action="" method = "post" enctype = "multipart/form-data">
    <div class="form-group">
        <label for="post_title" class = "control-label">Post_Title</label>
        <input type="text" name = "post_title" value = "<?php echo $post_title; ?>" class = "form-control">
    </div>
    <div class="form-group">
        <label for="post_category" class="control-label">Cateogry</label>
        <select name="post_category_id" id="">
            <?php
                $sql ="SELECT * FROM categories WHERE cat_id = $post_category_id";
                $result=mysqli_query($con,$sql);
                confirm_query($result);
                while($row = mysqli_fetch_assoc($result)){
                    $cat_id=$row['cat_id'];
                    $cat_title=$row['cat_title'];
            
            ?>
                <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
            <?php
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="" class = "control-label">Status</label>
        <select name="post_status" class = "form-control" id="">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            
            <?php
                if($post_status == 'draft'){
                    echo "<option value='publish'>publish</option>";
                }else{
                    echo "<option value='draft'>draft</option>";
                } 

            ?>
         </select> 
        
    </div>
    <div class="form-group">
        <label for="post_author" class = "control-label">Post_Author</label>
        <input type="text" name = "post_author" value = "<?php echo $post_author; ?>" class = "form-control">
    </div>
    <div class="form-group">
        <label for="post_image" class = "control-label">Post_Image</label>
        <input type="file" name = "post_image" >
    </div>
    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?>" width = "100px" alt="">
    </div>
    <div class="form-group">
        <label for="post_tag" class = "control-label">Post_Tag</label>
        <input type="text" name = "post_tag" value = "<?php echo $post_tag; ?>" class = "form-control">
    </div>
    <div class="form-group">
        <label for="post_content" class = "control-label">Post_Content</label>
        <textarea name = "post_content" cols = "30" rows = "10" class = "form-control">
            <?php echo $post_content; ?>
        </textarea>
    </div>
    <input type="submit" name = "edit_post" value = "Edit Post" class = "btn btn-primary">
</form>

<?php
     // and then, do edit post 
     if(isset($_POST['edit_post'])){
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);
        $post_author = escape($_POST['post_author']);

        $post_image = basename($_FILES['post_image']['name']);
        $post_image_tmp = $_FILES['post_image']['tmp_name'];

        $post_tag = escape($_POST['post_tag']);
        $post_content = escape($_POST['post_content']);

        if(empty($post_image)){ // or if($post_image == "")
            $sql = "SELECT post_image FROM post WHERE post_id = $p_id";
            $select_img = mysqli_query($con,$sql);
            confirm_query($select_img);

            $post_image = mysqli_fetch_row($select_img)[0];
        }

        move_uploaded_file($post_image_tmp,'../images/' . $post_image);

        $sql = "UPDATE post SET post_title='$post_title',post_category_id='$post_category_id',post_author='$post_author',
            post_date=now(),post_image='$post_image',post_tag='$post_tag',post_content='$post_content',post_status='$post_status'
             WHERE post_id = $p_id";

        $edit_post = mysqli_query($con,$sql);
        confirm_query($edit_post);
        echo "<p>Post Updated <a href='post.php'>Go Back View All Posts</a> </p>";
    }
?>
