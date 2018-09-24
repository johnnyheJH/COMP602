<?php

if (isset($_POST['addbook'])){
    
    include_once 'dbh-inc.php';
    
    $book_title = mysqli_real_escape_string($conn, $_POST['booktitle']);
    $author = mysqli_real_escape_string($conn, $_POST['author']); 
    $isbn = mysqli_real_escape_string($conn, $_POST['isbn']); 
    $book_description = mysqli_real_escape_string($conn, $_POST['discription']);
    $book_edition = mysqli_real_escape_string($conn, $_POST['edition']);
    $book_year = mysqli_real_escape_string($conn, $_POST['publishyear']);
    $book_price = mysqli_real_escape_string($conn, $_POST['price']);
    
    //Error handlers
    //Check for empty fields
    if (empty($book_title) || empty($author) || empty($book_description) || 
        empty($book_edition) || empty($book_year) || empty ($book_price))  {
        header("Location: ../addbookpage.html?listing=empty");
        exit();
        
    } else {
        // Check if input characters are valid
        if (!preg_match("/^[0-9]*$/", $book_year) && (!preg_match("/^[0-9]*$/", $book_price)))
            {
             header("Location: ../addbookpage.html?invalid-char");
             exit();
        } else {
                
                    $sql = "INSERT INTO listing (listing_book_title, listing_author, listing_isbn, listing_description, listing_edition,
                            listing_publish_year, listing_price) VALUES ('$book_title','$author', '$isbn', '$book_description', '$book_edition', '$book_year', '$book_price');";
                    mysqli_query($conn, $sql);
                    
                    header("Location: ../choosingatool.html?added=success");
                    exit();
              }
          }
  }

else {
        header("Location: ../addBookPage.html?error=unknown");
        exit();

    }
            

