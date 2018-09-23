<!DOCTYPE html>
<html>
    <head>
        <title>Add new listing</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>


        <section class="main-container">
            <div class="main-wrapper">
                <h2>Add New Listing</h2>
                <form class="signup-form" action="includes/signup-inc.php"
                      method="POST">
                    Book name:<input type="text" name="book_name" placeholder="Enter book name here"><br>
                    Book genre:<input type="text" name="book_genre" placeholder="Genre"><br>
                    ISBN:<input type="text" name="isbn" placeholder="ISBN"><br>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
            
        </section>
    </body>
</html>

<?php
    include_once 'footer.php' ;
?>
