

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>UniShare</title>
<link rel="stylesheet" href="style/adding_book_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body background="background.png">

<div class="container">
<div class="logo-container">  
<img src="img/Logo.png" alt="logo" class="logo">
</div>

<div class="profileAvatar">
       <tr>
          <a href="profilePage.php">
           <td><button class="avbutton"><i class="fa fa-user icon"></i></button></td></a>
           <td><h3> <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?></h3></td>
           
       </tr>

</div>

<div id="buttonsContainer">

   
       <div class="btn1">
       <button type="button" ><a href="adding_book.php"><i class="fa fa-plus icon"></i>ADD BOOK</a></button>
       </div>

       <div class="btn2">
       <button type="button" ><a href="searchPage.html"><i class="fa fa-search icon"></i>SEARCH</a></button>
       </div>

       <div class="btn3">
       <button type="button" ><a href="explorePage.html"><i class="fa fa-compass icon"></i>EXPLORE</a></button>
       </div>



</div>

<div class="formContainer">
  
   <form role="form" method="post" action="">
      
       
       <input type="text" name="booktitle" placeholder="Book Title" required>

       
       <input type="text" name="author" placeholder="Author" required>

       
       <input type="number" name="isbn" placeholder="ISBN" required>

       
       <input class="discription" type="text" name="description" placeholder="Description" required>
       
       <input type="number" name="edition" placeholder="Edition No." required>

       
       <input type="number" name="publishyear" placeholder="Publish Year" required>
       
       
       <input type="number" name="price" placeholder="Book Price (NZD) ">
       
     <input class="addbook" type="submit" value="Add Book" name="submit" >
   </form>
   
   
   
   
</div>

</div>


<?php
    if(isset($_POST["submit"])){
       
        $hostname='localhost';
        $username='root';
        $password='root';

        try {
             
            $dbh = new PDO("mysql:host=$hostname;dbname=unishare",$username,$password);
 
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
            $sql = "INSERT INTO listing (booktitle, author, isbn, publishyear, edition, description, price) VALUES ('".$_POST["booktitle"]."','".$_POST["author"]."','".$_POST["isbn"]."','".$_POST["publishyear"]."','".$_POST["edition"]."','".$_POST["description"]."','".$_POST["price"]."')";
            
			//$id = $db->lastInsertId('listing_id');
            
            
            if ($dbh->query($sql)) {
                echo "<script type= 'text/javascript'>alert('Textbook  Added Successfully');</script>";
            }
            else{
                echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
            }

            $dbh = null;
            
            header('Location: listing_page.php?action=joined');
            exit;
           
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }

    }
?>

</body>
</html>