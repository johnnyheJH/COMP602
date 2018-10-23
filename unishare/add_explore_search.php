<?php require('includes/config.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Unishare</title>
   <link rel="stylesheet" href="style/add_explore_search_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body background="background.png">

  
  <div class="logo-container">  
    <img src="img/Logo.png" alt="logo" class="logo">
   </div>
   
   <div class="container">
   
   
   <div class="profileAvatar">
          
           <button class="avbutton"><a href="profilePage.php">Profile Page</a><i class="fa fa-user icon"></i></button>
           <h3> <?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?></h3>
          
   </div>
   <div class="buttonsContainer">
   
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
   
   </div>
</body>
</html>
