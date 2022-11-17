<?php
    // confirm_query
    function confirm_query($result){
        global $con;
        if(!$result){
            die("Fail" . mysqli_error($con));
        }
    }

    // create category
    function create_cat(){
        global $con;
        if(isset($_POST['create'])){
            $cat_title = $_POST['cat_title'];
            $sql = "INSERT INTO categories(cat_title) VALUES('$cat_title')";
            $result = mysqli_query($con,$sql);

            confirm_query($result);
        }
    }


    // delete category
    function delete_cat(){
        global $con;
        if(isset($_GET['delete'])){
            $cat_id = $_GET['delete'];
            $sql = "DELETE FROM categories WHERE cat_id = $cat_id";
            $result = mysqli_query($con,$sql);

            confirm_query($result);

            header('Location: admin_categories.php');
           // redirect("admin_categories.php");
        }
    }

    // escape function
    function escape($string){
        global $con;
        return mysqli_real_escape_string($con,$string);
    }

    // header location
    function redirect($path){
        header("Location: $path");
    }

    // clean register
    function clean_input($input){
        $input = trim($input);
        $input = htmlspecialchars($input);
        return $input;
    }
?>