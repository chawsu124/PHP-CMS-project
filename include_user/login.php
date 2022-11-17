<?php require_once "../admin/include_admin/db.php"; ?>

<?php require_once "../admin/function.php"; ?>

<!-- use session -->
<?php session_start(); ?> 

<?php // if you click login btn from login form,
        // retrieve username and password data from login form
    if(isset($_POST['login'])){
        // echo "world";
        $username = clean_input($_POST['username']);
        $password = clean_input($_POST['password']);

        // retrieve data (from database users table) which equal to username (from login form) 
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($con,$sql);
        confirm_query($result);

        
        while($row = mysqli_fetch_assoc($result)){
            // echo "row having";
            
            $db_username = $row['username']; // username from database
            $db_password = $row['password'];// password from database
            $db_user_role = $row['user_role']; // user_role from database
            
            // if you used with password_hash method, test with this way userpw to dbpw
            // if($password == password_verify($password,$db_password)){

            if($username == $db_username && $password == $db_password){ // if pw correct
                $_SESSION['username'] = $db_username;
                $_SESSION['password'] = $db_password;
                $_SESSION['user_role'] = $db_user_role;

                redirect("../admin/index.php");
            }else { // if pw wrong
                redirect("../index.php");
            }
         }
         
    }
    
?>

<!-- Login Form -->
<!-- <div class="well">
    <h3>Login-Form</h3>
    <legend></legend>
    <form action="" method = "post">
        <div class="form-group">
            <input type="text" name = "username" placeholder = "Please Enter Your Name" class = "form-control">
        </div>
        <div class="input-group">
                <input type="password" name = "password" placeholder = "Please Enter Your Password" class = "form-control">
                <span class="input-group-btn">
                    <button type="submit" name = "logIn" class="btn btn-primary" >
                        Login
                    </button>
                </span>
        </div>
    </form>
</div> -->
