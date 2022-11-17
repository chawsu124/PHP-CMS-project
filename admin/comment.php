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
                            <small>User Comments</small>
                        </h1>
                        
                        <table class = "table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Email</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Approved</th>
                                <th>Unapproved</th>
                            </tr>
                            <?php
                                $sql = "SELECT * FROM comments ORDER BY comment_id DESC";
                                $result = mysqli_query($con,$sql);
                                confirm_query($result);

                                while($row = mysqli_fetch_assoc($result)){
                                    $comment_id = $row['comment_id'];    
                                    $comment_author = $row['comment_author'];
                                    $comment_email = $row['comment_email'];
                                    $comment_content = $row['comment_content'];
                                    $comment_date = $row['comment_date'];
                                    $comment_status = $row['comment_status'];
                            ?>
                                    <tr>
                                        <td><?php echo $comment_id; ?></td>
                                        <td><?php echo $comment_author; ?></td>
                                        <td><?php echo $comment_email; ?></td>
                                        <td><?php echo $comment_content; ?></td>
                                        <td><?php echo $comment_date; ?></td>
                                        <td><?php echo $comment_status; ?></td>
                                        <td><a href="comment.php?approved=<?php echo $comment_id; ?>">Approved</a></td>
                                        <td><a href="comment.php?unapproved=<?php echo $comment_id; ?>">Unapproved</a></td>
                                        <td><a href="comment.php?delete=<?php echo $comment_id; ?>">Delete</a></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </table>
                        <?php
                            if(isset($_GET['approved'])){
                                $comment_id = $_GET['approved'];
                                $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";
                                confirm_query(mysqli_query($con,$sql));
                                redirect('comment.php');
                            }

                            if(isset($_GET['unapproved'])){
                                $comment_id = $_GET['unapproved'];
                                $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";
                                confirm_query(mysqli_query($con,$sql));
                                redirect('comment.php');
                            }

                            if(isset($_GET['delete'])){
                                $comment_id = $_GET['delete'];
                                $sql = "DELETE FROM comments WHERE comment_id = $comment_id";
                                confirm_query(mysqli_query($con,$sql));
                                redirect('comment.php');
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