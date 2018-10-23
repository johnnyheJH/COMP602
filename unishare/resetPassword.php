<?php require('includes/config.php'); 

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }
$resetToken = hash('SHA256', ($_GET['key']));
$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $resetToken));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//if no token from db then kill the page
if(empty($row['resetToken'])){
	$stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'Your password has already been changed!';
}
//if form has been submitted process it
if(isset($_POST['submit'])){
	if (!isset($_POST['password']) || !isset($_POST['passwordConfirm']))
		$error[] = 'Both Password fields are required to be entered';
	//basic validation
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}
	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}
	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}
	//if no errors have been created carry on
	if(!isset($error)){
		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);
		try {
			$stmt = $db->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));
			//redirect to index page
			header('Location: login.php?action=resetAccount');
			exit;
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}

//$title = 'Reset Password';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
   <link rel="stylesheet" href="style/restpsw.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
<body background="background.png">

   <div calss="container">
       
         
     <img src="img/Logo.png" alt="logo" class="logo">
       
       
       <?php if(isset($stop)){
	    		echo "<p class='bg-danger'>$stop</p>";
	    	} else { ?>
       
       <form role="form" method="post" action="" autocomplete="off" >
         
                   <?php
					
					//check the action
					switch ($_GET['action']) {
						case 'active':
							echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
					}
					?>
          

           <div class="forgotPsw-container">

               <p>Enter your New Password</p>      
               <i class="fa fa-lock icon"></i>
               <input type="password" placeholder="Password" name="password" required>     
               <i class="fa fa-lock icon"></i>
               <input type="password" placeholder="Confirm Password" name="passwordConfirm" required>    
               <input type="submit"  class="button" value="Reset Password" name="submit" />
               <p><a href='login.php'>Back to login page</a></p>

           </div>
       </form>
       
   </div>
   
</body>
</html>



