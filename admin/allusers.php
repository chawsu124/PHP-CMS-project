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
                            <small>Users</small>
                        </h1>
                        
                        <table class = "table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>User Role</th>
                                <th>Admin</th>
                                <th>Subscriber</th>
                                <th>Edit user</th>
                                <th>Delete User</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($con,$sql);
                                confirm_query($result);

                                while($row = mysqli_fetch_assoc($result)){
                                    $user_id = $row['user_id'];    
                                    $username = $row['username'];
                                    $email = $row['email'];
                                    $password = $row['password'];
                                    $user_role = $row['user_role'];

                                   
                            ?>
                                    <tr>
                                        <td><?php echo $user_id; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $password; ?></td>
                                        <td><?php echo $user_role; ?></td>
                                        <td><a href="allusers.php?admin=<?php echo $user_id; ?>">Admin</a></td>
                                        <td><a href="allusers.php?subscriber=<?php echo $user_id; ?>">Subscriber</a></td>
                                        <td><a href="edit_user.php?edit=<?php echo $user_id; ?>">Edit</a></td>
                                        <td><a href="allusers.php?delete=<?php echo $user_id; ?>">Delete</a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </table>
                       <?php
                            if(isset($_GET['admin'])){
                                $user_id = $_GET['admin'];
                                $sql = "UPDATE users SET user_role = 'admin' WHERE user_id = $user_id";
                                confirm_query(mysqli_query($con,$sql));
                                redirect('allusers.php');
                            }

                            if(isset($_GET['subscriber'])){
                                $user_id = $_GET['subscriber'];
                                $sql = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $user_id";
                                confirm_query(mysqli_query($con,$sql));
                                redirect('allusers.php');
                            }

                            if(isset($_GET['delete'])){
                                $user_id = $_GET['delete'];
                                $sql = "DELETE FROM users WHERE user_id = $user_id";
                                confirm_query(mysqli_query($con,$sql));
                                 redirect('allusers.php');
                            }

                       ?>
                    </div>
                </div>
                <!-- /.row -->

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