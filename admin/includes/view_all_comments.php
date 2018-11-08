<table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>AUTHOR</th>
                                    <th>COMMENT</th>
                                    <th>EMAIL</th>
                                    <th>STATUS</th>
                                    <th>IN RESPONSE TO</th>
                                    <th>DATE</th>
                                    <th>APPROVE</th>
                                    <th>UNAPPROVE</th>
                                    <th>DELETE</th>
                                   
                                </tr>
                            </thead>




                            <tbody>
                                <?php                                 
                                    $query = "SELECT * FROM comments ";
                                    $comments_query = mysqli_query($connection, $query);                                                            
                                    while($row = mysqli_fetch_assoc($comments_query)){
                                        $comment_id = $row["comment_id"];
                                        $comment_post_id = $row["comment_post_id"];
                                        $comment_author = $row["comment_author"];
                                        $comment_email = $row["comment_email"];
                                        $comment_content = substr($row["comment_content"], 0, 100);
                                        $comment_status = $row["comment_status"];
                                        $comment_date = $row["comment_date"];
                                        
                                        

                                        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                        $select_post_id_query = mysqli_query($connection, $query);
                                    
                                        while($row = mysqli_fetch_assoc($select_post_id_query)){
                                            $post_title = $row["post_title"];
                                        }

                                        echo"
                                            <tr>
                                                <td>$comment_id</td>
                                                <td>$comment_author</td>
                                                <td>$comment_content...</td>
                                                <td>$comment_email</td>
                                                <td>$comment_status</td>
                                                <td><a href='../post.php?p_id=$comment_post_id'>{$post_title}</a></td>
                                                <td>$comment_date</td>
                                                <td><a href='comments.php?approve={$comment_id}'><i class='fa fa-check-square-o fa-2x' aria-hidden='true'></i></a></td>
                                                <td><a href='comments.php?unapprove={$comment_id}'><i class='fa fa-times-circle fa-2x' aria-hidden='true'></i></a></td></td>
                                                <td><a href='comments.php?delete={$comment_id}'><i class='fa fa-trash-o fa-2x' aria-hidden='true'></i></a></td>
                                            </tr>";
                                    }      
                                    
                                    if(isset($_GET['delete'])){
                                        $the_comment_id = $_GET['delete'];
                                
                                    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
                                    $delete_query = mysqli_query($connection, $query);
                                
                                
                                    $query2 = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
                                    $query2 .= "WHERE post_id = $comment_post_id ";
                                    $update_query = mysqli_query($connection,$query2);
                                    header("Location: comments.php");
                                
                                
                                    }
                                            
                                ?>


                            </tbody>
                        </table>

<?php

   


?>

<?php

if(isset($_GET['approve'])){
    $the_comment_id = $_GET['approve'];

$query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id";
$approve_query = mysqli_query($connection, $query);
header("Location: comments.php");
}


?>

<?php

if(isset($_GET['unapprove'])){
    $the_comment_id = $_GET['unapprove'];

$query = "UPDATE comments SET comment_status = 'Unapproved'WHERE comment_id = $the_comment_id ";
$unapprove_query = mysqli_query($connection, $query);
header("Location: comments.php");
}


?>