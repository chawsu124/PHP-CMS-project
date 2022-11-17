<?php
    include_once "include_user/header_user.php";
?>

    <?php
        include_once "admin/function.php";
    ?>

    <!-- Navigation -->
    <?php
        include_once "include_user/nav_user.php";
    ?>

    <?php
        // if you click register, do register job
        $message = "";
        if(isset($_POST['register'])){
            $username = clean_input($_POST['username']);
            $email = clean_input($_POST['email']);
            $password = clean_input($_POST['password']);

            // if you want to use password_hash value, write this
            //$password = password_hash($password,PASSWORD_BCRYPT,['kyite' => true]);

            if(empty($username) || empty($email) || empty($password)){
                echo "<script>alert('Fail ! Cannot be blank ')</script>";
            }
            else{
                $username = escape($username);
                $email = escape($email);
                $password = escape($password);

                $sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
                confirm_query(mysqli_query($con,$sql));
                $message = "Register Success";
            }
        }
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well">
                    <form action="" method = "post">
                        <h3 class = "text-center">Register Form</h3>
                        <legend></legend>
                        <p class="bg-success">
                            <?php echo $message; ?>
                        </p>
                        <div class="form-group">
                            <input type="text" name = "username" placeholder = "Please Enter Your Name" class = "form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name = "email" placeholder = "somebody@gmail.com" class = "form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name = "password" placeholder = "Please Enter Your Password" class = "form-control">
                        </div>
                        <input type="submit" name = "register" value = "Register" class = "btn btn-success btn-block">
                    </form>
                </div>    
            </div>
        </div>    
    </div>