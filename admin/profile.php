<?php include 'includes/admin_header.php'; ?>

<?php

    if(isset($_SESSION['username'])){
        
    }

?>


    <div id="wrapper">



        <!-- Navigation -->
        <?php include 'includes/admin_nav.php'; ?>


        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small>with style.</small>
                        </h1>
                        
                    <?php
                        if(isset($_SESSION['user_id'])){
                            $admin_id = $_SESSION['user_id'];
                            $query = "SELECT * FROM users WHERE user_id = '{$admin_id}'";
                                $select_user_by_id = mysqli_query($connection, $query);                                                            
                                while($row = mysqli_fetch_assoc($select_user_by_id)){
                                    $user_id = $row["user_id"];
                                    $user_firstname = $row["user_firstname"];
                                    $user_lastname = $row["user_lastname"];
                                    $user_email = $row["user_email"];
                                    $username = $row["username"];
                                    $user_password = $row["user_password"];
                                    $user_image = $row["user_image"];    
                                }

                                if(isset($_POST['update_user'])) {
                                    $user_firstname = $_POST['user_firstname'];
                                    $user_lastname = $_POST['user_lastname'];
                                    $user_email = $_POST['user_email'];
                                    $username = $_POST['username'];
                                    $user_image = $_FILES['image']['name'];
                                    $user_image_temp = $_FILES['image']['tmp_name'];
                                    $user_password = $_POST['user_password'];
            
                                    move_uploaded_file($user_image_temp, "../images/$user_image");

                                    if(empty($user_image)) {
                                        $image_query = "SELECT * from users WHERE user_id = $admin_id";
                                        $select_image = mysqli_query($connection, $image_query);
                                        while($row = mysqli_fetch_array($select_image)) {
                                            $user_image = $row['user_image'];
                                        }
                                    }

                                    $query = "SELECT randsalt FROM users";
                                    $select_randsalt_query = mysqli_query($connection, $query);

                                    if(!$select_randsalt_query){
                                        die("Query Failed" . mysqli_error($connection));
                                    }

                                    $row = mysqli_fetch_array($select_randsalt_query);
                                    $salt = $row['randsalt'];
                                    $hashed_password = crypt($user_password, $salt);

                                    $query = "UPDATE users SET ";
                                    $query .="user_firstname = '{$user_firstname}', ";
                                    $query .="user_lastname = '{$user_lastname}', ";
                                    $query .="user_email = '{$user_email}', ";
                                    $query .="username = '{$username}', ";
                                    $query .="user_image = '{$user_image}', ";
                                    $query .="user_password = '{$hashed_password}' ";
                                    $query .="WHERE user_id = {$admin_id} ";

                                    $update_user_query = mysqli_query($connection, $query);

                                    if(!$update_user_query) {
                                        die("Query Failed " . mysqli_error($connection));
                                    }

                                }
                        }
                    ?>
                        
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
                            </div>

                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email">
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input value="<?php echo $username; ?>" type="text" class="form-control" name="username">
                            </div>

                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password">
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                                <img width="100" src="../images/<?php echo $user_image; ?>" alt="">
                            </div>

                            

                            <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="UPDATE">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->
<?php include 'includes/admin_footer.php'; ?>