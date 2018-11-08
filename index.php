
<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-header">
                    POSTS
                    <small>stuff and things</small>
                </h1>
                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'Published' ";
                    $select_all_posts_query = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            displaySetupForPost($row);
                        }
                ?>
            </div>
           <?php include 'includes/sidebar.php'; ?>
        </div>
        <hr>
<?php include 'includes/footer.php'; ?>

     
