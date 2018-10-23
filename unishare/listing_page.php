<?php require_once('includes/config.php'); 

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Computer Science</title>
   <link rel="stylesheet" href="style/listing_page_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body background="background.png">

  
  <div class="logo-container">  
    <img src="img/Logo.png" alt="logo" class="logo">
   </div>
   
   <div class="container">
   
   
       <div class="profileAvatar">
              <tr>
           <td><a href="profilePage.php"><button class="avbutton"><i class="fa fa-user icon"></i></button> </a></td>
           <td><h3> <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?></h3></td>
       </tr>
       </div>
       
       <div class="photosContainer">
           <img src="img/plus.png" alt=""> <img src="img/plus.png" alt=""> <img src="img/plus.png" alt=""> <img src="img/plus.png" alt="">
           <input type="file">
       </div>
       
       
          
       
       <div class="postContainer">
         
                
            <h2><?php echo htmlspecialchars($_SESSION['booktitle'], ENT_QUOTES); ?> </h2>
           
           <div class="bookDetails">
           <table>
           
            <tr>
            <td>Author:   <?php echo htmlspecialchars($_SESSION['author'], ENT_QUOTES); ?> </td>
            <td>ISBN:  <?php echo htmlspecialchars($_SESSION['isbn'], ENT_QUOTES); ?>  </td>
            </tr>
            
            <tr>
            <td>Publish Year:  <?php echo htmlspecialchars($_SESSION['publishyear'], ENT_QUOTES); ?>   </td>   
            
            <td>Edition:    <?php echo htmlspecialchars($_SESSION['edition'], ENT_QUOTES); ?>  </td>
            </tr>
            </table>
          </div>
                  
           
        
       </div>
       <div class="descriptionContainer">
           
           <h2>Description: </h2>
           <?php echo htmlspecialchars($_SESSION['description'], ENT_QUOTES); ?>
           
       </div>
       
       <button type="button" > Save</button>
      
   
      

   
   </div>
</body>
</html>
