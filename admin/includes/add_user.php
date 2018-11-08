<?php
if(isset($_POST['create_user'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $username = $_POST['username'];
    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];

    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "SELECT randsalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    
    if(!$select_randsalt_query){
        die("Query Failed" . mysqli_error($connection));
    }

    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randsalt'];
    $hashed_password = crypt($user_password, $salt);

    $query = "INSERT INTO users(user_firstname, user_lastname, user_email, username, user_image, user_password, user_role) ";
    $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$username}', '{$user_image}', '{$hashed_password}', '{$user_role}' ) ";

    $create_user_query = mysqli_query($connection, $query);

    if(!$create_user_query) {
        die("Query Failed " . mysqli_error($connection));
    }

    echo "User Created: " . " " . " <a href='users.php'>View Users</a>";
}
?>

<form action="" method="POST" enctype="multipart/form-data">

     <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

     <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>
 
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>


    <div class="form-group">
        <label for="user_role">Role</label>
        <br>
        <select name="user_role" id="">
            <option value="subscriber">Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="ADD USER">
    </div>

</form>