<?php include 'includes/header.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <div class="container">
        <div class="row">
        <?php
           if(isset($_GET['p_id'])){
                $post_to_display_id = $_GET['p_id'];
                
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_to_display_id ";
                $send_query = mysqli_query($connection, $view_query);

                $query = "SELECT * FROM posts WHERE post_id = $post_to_display_id";
                $select_all_posts_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                    $post_title = $row["post_title"];
                    
                }
            }else{
                header("Location: /phportfolio/index");
            }
        ?>

            <div class="col-md-8">
                <h1 class="page-header">
                    <?php echo $post_title?>
                </h1>

                <?php 
                        $query = "SELECT * FROM posts WHERE post_id = $post_to_display_id";
                        $select_all_posts_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){

                            $post_id = $row['post_id'];
                            $post_title = $row["post_title"];
                            $post_date = $row["post_date"];
                            $post_image = $row["post_image"];
                            $post_content = $row["post_content"];
                            
                            echo "
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
