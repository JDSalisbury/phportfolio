
<?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <?php
                if(isset($_GET['c_id'])){
                    $category_id = $_GET['c_id'];
                }

                $query = "SELECT * FROM categories WHERE cat_id = $category_id";
                $select_all_categories_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_all_categories_query)){
                    $cat_title = $row["cat_title"];  
                    
                }

            ?>
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    <?php echo $cat_title; ?>
                    <small>stuff and things</small>
                </h1>

                <!-- First Blog Post -->
                <?php 

                    $query = "SELECT * FROM posts WHERE post_category_id = $category_id";
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

     
