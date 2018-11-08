
<?php include 'includes/header.php'; ?>
    
    <?php include 'includes/nav.php'; ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    POSTS
                    <small>stuff and things</small>
                </h1>

                <!-- First Blog Post -->
                <?php 
                     if(isset($_POST['search'])){

                        $search = $_POST['search'];

                         $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";

                        $search_query = mysqli_query($connection, $query);

                        if(!$search_query) {
                            die("query failed" . mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($search_query);
                        
                        if($count == 0 ){

                            echo "<h1> SEARCHING '$search' YEILDED NO RESULTS</h1>";
                        } else {
                            
                            
                            $select_all_posts_query = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_assoc($select_all_posts_query)){
                            
                                    displaySetupForPost($row);
                                }

                        }
                        }



                ?>
            </div>
           <?php include 'includes/sidebar.php'; ?>
        </div>
        <hr>
<?php include 'includes/footer.php'; ?>

     
