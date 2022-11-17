<?php
    include_once "include_admin/admin_header.php";
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
                            Update User
                        </h1>
                    </div> 
                </div>

                <?php
                // select user data from database
                    if(isset($_GET['edit'])){
                        $user_id = $_GET['edit'];

                        $sql = "SELECT * FROM users WHERE user_id = $user_id";
                        $result = mysqli_query($con,$sql);
                        confirm_query($result);

                        while($row = mysqli_fetch_assoc($result)){
                            $user_id = $row['user_id'];    
                            $db_username = $row['username'];
                            $db_email = $row['email'];
                            $db_password = $row['password'];
                            $db_user_role = $row['user_role'];
                        
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method = "post">
                            <div class="form-group">
                                <label for="" class = "control-label">User Name</label>
                                <input type="text" name = "username" value = "<?php echo $db_username; ?>" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class = "control-label">Email</label>
                                <input type="text" name = "email" value = "<?php echo $db_email; ?>" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class = "control-label">Password</label>
                                <input type="password" name = "password" value = "<?php echo $db_password; ?>" class = "form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class = "control-label">User Role</label>
                                <select name="user_role" class = "form-control" id="">
                                    <option value="<?php echo $db_user_role ?>"><?php echo $db_user_role ?></option>
                                    
                                    <?php
                                        if($db_user_role == 'admin'){
                                            echo "<option value='subscriber'>subscriber</option>";
                                        }else{
                                            echo "<option value='admin'>admin</option>";
                                        } 

                                    ?>
                                </select> 
                            </div>
                            <input type="submit" name = "update_profile" value = "Update Profile" class = "btn btn-primary">
                        </form>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
                <!-- /.row -->

                <?php
                    if(isset($_POST['update_profile'])){
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $user_role = $_POST['user_role'];

                        $sql = "UPDATE users SET username = '$username',email = '$email',
                                password = '$password',user_role = '$user_role' 
                                WHERE user_id = $user_id";
                        $update_user_query = mysqli_query($con,$sql);
                        confirm_query($update_user_query);

                        echo "<p>Update Successfully</p>";
                    }
                ?>
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