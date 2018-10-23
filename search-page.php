<head>
<link rel="stylesheet" href="css/search-result.css">
</head>

<?php

include 'includes/dbh-inc.php';

?>

<h1>Search Results</h1>

<div class="listing-container>">
    
<?php
    
    //Checks the 'Search" button has been pressed   
    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        //Searches for key words and similarites, not exact matches
        $sql = "SELECT * FROM listing WHERE listing_book_title LIKE '%$search%' OR listing_description LIKE '%$search%' OR listing_author LIKE '%$search%'
        OR listing_isbn LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
        
        //Displays how many results
        echo "There are ".$queryResult." results!";
        
        if ($queryResult > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {   
                //Echo's out the details of the listing from the database
                echo "<a href='listing.php?id=".$row['listing_id']."'><div             class='listing-box'>
                     <h3>".$row[ 'listing_book_title' ]."</h3>
                     <p>".$row[ 'listing_author' ]."</p>
                     <p> ISBN: ".$row[ 'listing_isbn' ]." | Edition: ".$row[ 'listing_edition' ]."</p>
                     <p> $".$row[ 'listing_price' ]."</p>
                     <p>".$row[ 'listing_description' ]."</p>
                     </div>";
                }
            
            }
            
        }
        else
        {
            echo "Sorry, there are no results matching your search.";
        
        }
    ?>
    </div>