<?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <?php
                if(isset($_GET['author'])){
                    $author = $_GET['author'];
                }
            ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    POSTS
                    <small>by <?php echo $author?></small>
                </h1>

                <!-- First Blog Post -->
                <?php 
                    


                $query = "SELECT * FROM posts WHERE post_author = '{$author}'";
                    $select_all_posts_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){

                            $post_id = $row['post_id'];
                            $post_title = $row["post_title"];
                            $post_author = $row["post_author"];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_content = substr($row["post_content"], 0, 200);
                        
                            
                            
                            echo "<h2><a href='/phportfolio/post/$post_id'>{$post_title}</a></h2>
                                <p><span class='glyphicon glyphicon-time'></span>{$post_date}</p>
                                <hr>
                                <img class='img-responsive' src='/phportfolio/images/{$post_image}' alt=''>
                                <hr>
                                <p>{$post_content}</p>
                                <hr>";
                        }
                ?>
            </div>
           <?php include 'includes/sidebar.php'; ?>
        </div>
        <hr>
<?php include 'includes/footer.php'; ?>