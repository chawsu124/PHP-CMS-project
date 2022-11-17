<!-- <?php
    //ob_start();
?> -->

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
                            Welcome to Admin
                            <small>Categories</small>
                        </h1>
                        <?php
                            create_cat();
                        ?>
                        <!-- Categories Form -->
                        <div class="col-md-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="">New Category</label>
                                    <input type="text" name = "cat_title" class = "form-control">
                                </div>
                                <input type="submit" name = "create" value = "Create Category" class = "btn btn-primary">
                            </form>

                            <!-- Edit Categories -->
                            <?php
                                if(isset($_GET['edit'])){ // $_GET['edit'] is receive from edit button in showAll Form 
                                    $cat_id = $_GET['edit'];
                                    $sql = "SELECT * FROM categories WHERE cat_id = $cat_id";
                                    $result = mysqli_query($con,$sql);

                                    confirm_query($result);

                                    $row = mysqli_fetch_assoc($result);

                                    $cat_title = $row['cat_title'];

                                    if(isset($_POST['update'])){
                                        $cat_title = $_POST['cat_title'];
                                        $sql = "UPDATE categories SET cat_title = '$cat_title' WHERE cat_id = $cat_id";
                                        $result = mysqli_query($con,$sql);
                                        confirm_query($result);
                                    }
                                ?>
                                <form action="" method = "post">
                                    <div class="form-group">
                                        <label for="" class = "control-label">Edit Categories</label>
                                        <input type="text" name = "cat_title" value = "<?php echo $cat_title ?>" class = "form-control">
                                    </div>
                                    <input type="submit" name = "update" value = "Update Category" class = "btn btn-primary">
                                </form>
                                <?php
                                    }
                            ?>
                            <!--end Edit Categories -->
                        </div>
                        <!--end Categories Form -->

                        <div class="col-md-6">
                            <table class = "table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                </tr>
                                <?php
                                    // show all categories in Table form
                                    $sql = "SELECT * FROM categories";
                                    $result = mysqli_query($con,$sql);

                                    confirm_query($result);

                                    while($row = mysqli_fetch_assoc($result)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];

                                        echo "<tr>";
                                        echo "<td>$cat_id</td>";
                                        echo "<td>$cat_title</td>";
                                        echo "<td><a href='admin_categories.php?edit=$cat_id'>Edit</a></td>";// edit is $cat_id
                                        echo "<td><a class='confirm_delete' href='admin_categories.php?delete=$cat_id'>Delete</a></td>";// delete is $cat_id
                                        echo "<tr>";
                                    }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

     <?php
        // Delete Category
        delete_cat()
     ?>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- confirm delete category -->
    <script src="js/script.js"></script>
</body>

</html>