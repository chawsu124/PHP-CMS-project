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
        // if you click submit btn, sending email to admin of website
        if(isset($_POST['submit'])){
            $to = "chawsu12499@gmail.com";
            $subject = $_POST['subject'];
            $from = $_POST['email'];
            $body = wordwrap($_POST['body'],70);

            mail($to,$subject,$body,$from);
        }
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="well">
                    <h1 class = "text-center">Contact Us</h1>
                    <form action="" method = "post">
                        <div class="form-group">
                            <label for="" class = "sr-only">Email</label>
                            <input type="email" name = "email" class = "form-control" placeholder = "Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="" class = "sr-only">Subject</label>
                            <input type="text" name = "subject" class = "form-control" placeholder = "Enter subject">
                        </div>
                        <div class="form-group">
                            <textarea name="body" id="" cols="42" rows="10"></textarea>
                        </div>
                        <input type="submit" name = "submit" value = "Submit" class = "btn btn-success btn-block">
                    </form>
                </div>    
            </div>
        </div>    
    </div>