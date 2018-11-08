<?php include 'db.php';?>
<?php




function navBarCategoriesDisplay(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_all_categories_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_all_categories_query)){
       $cat_title = $row["cat_title"];
       $cat_id = $row["cat_id"];   
       echo "<li><a href='/phportfolio/category/$cat_id'>{$cat_title}</a></li>";
    }

}





function tagSearchBar(){
    global $connection;
    global $search_query;

    if(isset($_POST['search'])){

        $search = $_POST['search'];
    
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
    
        $search_query = mysqli_query($connection, $query);
    
        if(!$search_query) {
            die("query failed" . mysqli_error($connection));
        }
    
    }
    if(!$search_query == null){
        $count = mysqli_num_rows($search_query);
    }else {
        $count = -1;
    }
    global $numOfItemsFound;
    if($count == 1){
        $numOfItemsFound = $count . " item found";
    } elseif($count == -1) {
        $numOfItemsFound = "";
    } else{ 

        $numOfItemsFound = $count . " items found";
    }
}





function displaySetupForPost($row){
    $post_id = $row['post_id'];
    $post_title = $row["post_title"];
    $post_date = $row["post_date"];
    $post_image = $row["post_image"];
    $post_content = substr($row["post_content"], 0, 200);

    
    
    echo "<h2><a href='/phportfolio/post/$post_id'>{$post_title}</a></h2>
        <p><span class='glyphicon glyphicon-time'></span>{$post_date}</p>
        <hr>
        <img class='img-responsive' src='/phportfolio/images/{$post_image}' alt=''>
        <hr>
        <p>{$post_content}...</p>
        <hr>";

}





?>