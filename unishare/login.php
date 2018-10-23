<?php

require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ 
    header('Location: index.php'); 
    exit(); 
}

//process login form if submitted
if(isset($_POST['submit'])){
//	if (!isset($_POST['username'])) $error[] = "Please fill out all fields";
//	if (!isset($_POST['password'])) $error[] = "Please fill out all fields";
    
	$email = $_POST['email'];
    $password = $_POST['password'];
        
    if($user->login($email,$password)){
        $_SESSION['email'] = $email;
        header('Location: memberpage.php');
        exit;
    } else {
        $error[] = 'Wrong username or password or your account has not been activated.';
    }
	
}

//define page title
$title = 'Login';


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniShare</title>
   <link rel="stylesheet" href="style/login_page_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
<body background="background.png">
  
   
  <div calss="container">
       
         
     <img src="img/Logo.png" alt="logo" class="logo">
       
       
       <form role="form" method="post" action="" autocomplete="off" >
          
              <?php
				
                if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
           
				if(isset($_GET['action'])){
					//check the action
					switch ($_GET['action']) {
                            
                            
						case 'active':
							echo "<h2 class='bg-success'> Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
						case 'resetAccount':
							echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
							break;
					}
				}
				
				?>
          
           <div class="login-container">

               <i class="fa fa-envelope icon" style="width: 8.8px"></i>
               <input type="text" placeholder="Enter Your Email" name="email" required>

               <i class="fa fa-lock icon"></i>
               <input type="password" placeholder="Enter your password" name="password" required>

               <input type="submit" class="button" value="Login" name="submit" />

              <span class="forgot-psw"> <a href='reset.php'> Forgot password?</a></span>

               <p> You don’t have an account?</p>
               <span class="sign-up-link"><a href="index.php">Sign Up</a></span>      

           </div>
       </form>
    </div>
    
    
   <div>
       <footer>
        <p>Copyrights: Team Crescent</p>
      </footer>
   </div>
   
</body>
</html>