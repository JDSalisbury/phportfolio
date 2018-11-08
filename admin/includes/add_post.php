<?php
if(isset($_POST['create_post'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
 
    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);

    if(!$create_post_query) {
        die("Query Failed " . mysqli_error($connection));
    }

    $the_post_id = mysqli_insert_id($connection);
    echo "Post Created: " . " " . " <a href='posts.php'>View Posts: </a><a href='../post.php?p_id={$the_post_id}'>View Post</a>";
}
?>


<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="post_category">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection, $query);           
                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_title = $row["cat_title"];
                    $cat_ID = $row["cat_id"];
                    echo "<option value='{$cat_ID}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="post_status" id="">
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="editor" class="form-control" name="post_content" cols="50" rows="50"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="PUBLISH">
    </div>
    
</form>