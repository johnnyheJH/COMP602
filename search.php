<?php
    inlcude 'search-header';
?>

<form action="search.php" method="POST">
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit-search">Search</button>
    
</form>
<h1>Search Page</h1>
<h2>Latest Listings</h2>

<div class="listing-container">
     <?php 
            $sql = "SELECT * FROM listings";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
    
            if ($queryResults > 0) 
            {
                
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<div class='listing-box'>
                          <h3>".$row['listing_title']."</h3>
                          <p>".$row['listing_price']."</p>
                          <p>".$row['listing_description']."</p>
                          <p>".$row['listing_date']."</p>
                          <p>".$row['user_firstname']. .$row['user_last_name']."</p>
                          </div>";
                
                }
                    
            }
     ?>
     
</div>
    
</body>
</html>