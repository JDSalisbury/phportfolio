
<?php include 'includes/admin_header.php'; ?>
    <div id="wrapper">



        <!-- Navigation -->
        <?php include 'includes/admin_nav.php'; ?>


        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            CATEGORIES
                            <small>for categorization.</small>
                        </h1>



                        <div class="col-xs-6">
                        <?php 
                                if(isset($_POST['submit'])){
                                    
                                    $cat_title = $_POST['cat_title'];
                                    
                                    if($cat_title == "" || empty($cat_title)){
                                        echo "This field cannot be empty";
                                    } else {
                                        $query = "INSERT INTO categories(cat_title) ";
                                        $query .= "VALUE('{$cat_title}')";
                                        
                                        $create_category_query = mysqli_query($connection, $query);
                                        
                                        if(!$create_category_query){
                                            die("Query Failed" . mysqli_error($connection));
                                        }
                                    }
                                }
                            ?>

                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for='cat_title'>CATEGORY TITLE</label>
                                    <input class='form-control' type="text" name='cat_title'>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name='submit' value="ADD CATEGORY" >
                                </div>
                            </form>


                            <?php ; 
                            
                                if(isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];

                                    include 'includes/update_cat.php';  
                                }

                            ?>

                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>CATEGORY TITLE</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //find all cats query
                                        $query = "SELECT * FROM categories";
                                        $select_all_categories_for_admin_query = mysqli_query($connection, $query);  

                                        //delete a cat by ID query
                                        if(isset($_GET['delete'])){
                                            $the_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                                        $delete_query = mysqli_query($connection, $query);
                                        header("Location: categories.php");
                                        }


                                        while($row = mysqli_fetch_assoc($select_all_categories_for_admin_query)){
                                            $cat_title = $row["cat_title"];
                                            $cat_ID = $row["cat_id"];
                                                echo "<tr>";
                                                echo "<td>{$cat_ID}</td>";
                                                echo "<td>{$cat_title}</td>";
                                                echo "<td><a href='categories.php?delete={$cat_ID}'><i class='fa fa-fw fa-trash fa-lg' aria-hidden='true'></i></a><a href='categories.php?edit={$cat_ID}'><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></a></td>";
                                                echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        


                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->
<?php include 'includes/admin_footer.php'; ?>