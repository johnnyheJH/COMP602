<?php require('includes/config.php'); 
//if not logged in redirect to login page
if(!$user->is_logged_in()){ 
    header('Location: login.php'); 
    exit(); }
//define page title
$title = 'Members Page';
//include header template
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniShare</title>
   <link rel="stylesheet" href="style/major_page_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body background="background.png">

       
           
       <div class="logo-container">  
            <img src="img/Logo.png" alt="logo" class="logo">
       </div>
       
       <div class="profileAvatar">
           <button><a href="profilePage.php"></a><i class="fa fa-user icon"></i></button>
           <h3><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES); ?></h3>
           
       </div>
       
       
       <div class="buttons1">
         
          
          <h2>CHOOSE YOUR MAJOR </h2>
          <button type="submit" class="et_pb_button" title="Relevant Title" ><a href="engineering_page.php">Engineering</a></button>
          
          <button class="et_pb_button" title="Relevant Title" ><a href="computer_sci_page.php">Computer Scinece</a></button>
          
          <button class="et_pb_button" title="Relevant Title" ><a href="Buisness_page.php">Buisness</a></button>
          
          <button class="et_pb_button" title="Relevant Title" ><a href="art_design_page.php">Art & Design</a></button>
          <button class="et_pb_button" title="Relevant Title" ><a href="health_sci_page.php">Health</a></button>
          
          <button class="et_pb_button" title="Relevant Title" ><a href="law_page.php">Law</a> </button>
           
      </div>
      

     





</body>
</html>