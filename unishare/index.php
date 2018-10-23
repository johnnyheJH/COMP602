<?php require('includes/config.php');


//if member already logged in redirect to members page
if( $user->is_logged_in() ){
    header('Location: memberpage.php'); 
    exit(); }

//if form has been submitted start processing 
if(isset($_POST['submit'])){
    
    
	$username = $_POST['username'];
    $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
    $stmt->execute(array(':username' => $username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $email = $_POST['email'];
    
	$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
	$stmt->execute(array(':email' => $email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
    
    // Password validations 
    // Validate the length of password
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}
	
    // check if Password and confirmed password are the same
	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}
    
	//email validation
	$email = htmlspecialchars_decode($_POST['email'], ENT_QUOTES);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $email));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
	}
	//if no errors have been created carry on
	if(!isset($error)){
        
		//hash the password 
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
        
		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
        
		try {
			//insert member details into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $username,
				':password' => $hashedpassword,
				':email' => $email,
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');
            
			//send email to Member
			$to = $_POST['email']; // user Email 
			$subject = "Registration Confirmation";
			$body = "<p>Thank you for registering at UniShare .</p>
			<p>To activate your account, please click on this link: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Regards Site Admin</p>";
			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
            
			//redirect to index page
			header('Location: index.php?action=joined');
			exit;
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}
//define page title
$title = 'UniShare';

?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniShare</title>
    <link rel="stylesheet" type="text/css" href="style/register_page_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body background="background.png">

   
     <div calss="container">
      
       

           <div class="logo-container">  
                <img src="img/Logo.png" alt="logo" class="logo">
           </div>

           <form role="form" method="post" action="index.php" autocomplete="off">

                <div class="signup-container">
                      <h5>Please fill in this form to create an account.</h5>
                      <hr>
                      
                      <?php
                        if(isset($error)){
					       foreach($error as $error){
                               echo '<p class="bg-danger">'.$error.'</p>';
					       }
				        }  
                        //if action is joined show sucess
                        if(isset($_GET['action']) && $_GET['action'] == 'joined'){
                            echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
                        }
				      ?>

                      <div>
                          <i class="fa fa-user icon"></i>
                          <input id="username" type="text" placeholder="Full Name" name="username" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" required >
                      </div>

                      <div>
                           <i class="fa fa-envelope icon" style="width: 8.8px"></i>
                           <input id="email" type="text" placeholder="Enter Your Email" name="email" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['email'], ENT_QUOTES); } ?>" required>
                      </div>

                       <div>
                           <i class="fa fa-lock icon"></i>
                           <input  id="psw" type="password" placeholder="Enter Password" name="password"  required>
                       </div>

                       <div>
                           <i class="fa fa-lock icon"></i>
                           <input  id="psw_cofirm" type="password" placeholder="Confirm Password" name="passwordConfirm" required>
                       </div>

                       <input type="submit" value="Sign Up" class="button" name="submit">

                       <p> You have an account already?</p>
                       <span class="login-link"><a href="login.php">Login</a></span>
               </div>

           </form>

      
       
   </div>
   
</body>
</html>