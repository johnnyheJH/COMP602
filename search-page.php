<?php
    inlcude 'search-header';
?>

<h1> Search Results</h1>
<?php
    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        $sql = "SELECT * FROM article WHERE listing_title LIKE '%search%' OR listing_description LIKE '%search%' OR listing_author LIKE '%search%' OR listing_papercode LIKE '%search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        
        if ($queryResult > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
            
            
            }
            
        }
        else
        {
            echo "Sorry, there are no results matching your search."
        
        }
    
    }