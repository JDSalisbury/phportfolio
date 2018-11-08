<table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>USERNAME</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>IMAGE</th>
                                    <th>ROLE</th>
                                    <th></th>
                                   
                                </tr>
                            </thead>




                            <tbody>
                                <?php                                 
                                    $query = "SELECT * FROM users ";
                                    $comments_query = mysqli_query($connection, $query);                                                            
                                    while($row = mysqli_fetch_assoc($comments_query)){
                                        $user_id = $row["user_id"];
                                        $username = $row["username"];
                                        $user_firstname = $row["user_firstname"];
                                        $user_lastname = $row["user_lastname"];
                                        $user_email = $row["user_email"];
                                        $user_image = $row["user_image"];
                                        $user_role = $row["user_role"];
                                    
                                        if($user_role == "admin"){
                                            $lvl = "<a href='users.php?change_to_sub={$user_id}'><i class='fa fa-arrow-circle-down fa-2x' aria-hidden='true'></i></a>";
                                        } else {
                                            $lvl = "<a href='users.php?change_to_admin={$user_id}'><i class='fa fa-arrow-circle-up fa-2x' aria-hidden='true'></i></a>";
                                        }

                                        echo"
                                            <tr>
                                                <td>$user_id</td>
                                                <td>$username</td>
                                                <td>$user_firstname</td>
                                                <td>$user_lastname</td>
                                                <td>$user_email</td>
                                                <td><img src='../images/$user_image' height= '50'></td>
                                                <td>$user_role</td>
                                                <td>$lvl  <a href='users.php?delete={$user_id}'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a>  <a href='users.php?source=edit_user&u_id={$user_id}'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></td>
                                            </tr>";
                                    }      
                                    
                                    if(isset($_GET['delete'])){
                                        if(isset($_SESSION['user_role'])) {
                                            if($_SESSION['user_role'] == 'admin') {

                                                $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                                                
                                                $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
                                                $delete_query = mysqli_query($connection, $query);
                                                header("Location: users.php");
                                            }
                                        }
                                    }   
                                ?>
                            </tbody>
                        </table>

<?php

if(isset($_GET['change_to_admin'])){
    $the_user_id = $_GET['change_to_admin'];

$query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
$approve_query = mysqli_query($connection, $query);
header("Location: users.php");
}


?>

<?php

if(isset($_GET['change_to_sub'])){
    $the_user_id = $_GET['change_to_sub'];

$query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
$unapprove_query = mysqli_query($connection, $query);
header("Location: users.php");
}


?>