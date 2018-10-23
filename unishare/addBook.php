<?php


//if( $user->is_logged_in() ){
//    header('Location: memberpage.php'); 
//    exit(); }

if (isset($_POST['submit'])){
    
    
    
    $hostname='localhost';
    $username='root';
    $password='root';
    
    
     try {
         $dbh = new PDO("mysql:host=$hostname;dbname=unishare",$username,$password);
 
         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
         $sql = "INSERT INTO listing (booktitle, author, isbn, publishyear, edition, description, price) VALUES ('".$_POST["booktitle"]."','".$_POST["author"]."','".$_POST["isbn"]."','".$_POST["publishyear"]."','".$_POST["edition"]."','".$_POST["description"]."','".$_POST["price"]."')";
            
			//$id = $db->lastInsertId('listing_id');
            
            //redirect to index page
         header('Location: ./listing_page.php?action=joined');
         exit;
    }catch(PDOException $e) {$error[] = $e->getMessage();}
            
           
} 
else {
        header("Location: ./adding_book.php?error=unknown");
        exit();
    
   }

?>
