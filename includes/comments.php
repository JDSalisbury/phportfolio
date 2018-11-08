<!-- Comments Form -->
<?php

if(isset($_POST['create_comment'])){
    $post_to_display_id = $_GET['p_id'];

    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment'];

    $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, Comment_date) ";
    $query .= "VALUES ($post_to_display_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

    $create_comment_query = mysqli_query($connection, $query);
        if(!$create_comment_query){
            die('Query Failed' . mysqli_error($connection));
        }

    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_to_display_id";
    $update_comment_count = mysqli_query($connection, $query);
}

?>
<div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">

                        <div class="form-group">
                            <label for="comment_author">Author:</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>

                        <div class="form-group">
                            <label for="comment_email">Email:</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="comment">Leave a comment:</label>
                            <textarea class="form-control" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_to_display_id} ";
                    $query .= "AND comment_status = 'Approved' ";
                    $query .= "ORDER BY comment_id DESC ";

                    $select_comment_query = mysqli_query($connection, $query);
                    if(!$select_comment_query){
                        die('Query Failed ' . mysqli_error($connection));

                    }
                    while ($row = mysqli_fetch_array($select_comment_query)) {
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_author = $row['comment_author'];

                        echo " 
                                <div class='media'>
                                    <a class='pull-left' href='#'>
                                        <img class='media-object' src='http://placehold.it/64x64' alt=''>
                                    </a>
                                    <div class='media-body'>
                                        <h4 class='media-heading'> {$comment_author}
                                            <small>$comment_date</small>
                                        </h4>
                                        $comment_content
                                    </div>
                                 </div>
                            ";
                    }
                
                ?>
                

                
                

               