<?php require('includes/config.php');


//if logged in redirect to members page
if( $user->is_logged_in() ){ 
    header('Location: memberpage.php'); 
    exit(); 
}


if(isset($_POST['submit'])){
    
    $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
    $stmt->execute(array(':email' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // to check if user email in the Database
    if(empty($row['email'])){
        $error[] = 'Email provided is not recognised.';
		}
	

	//if no errors continue the process 
	if(!isset($error)){
		//create the activation code
		$stmt = $db->prepare('SELECT password, email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
        
		$token = hash_hmac('SHA256', $user->generate_entropy(8), $row['password']);
        $storedToken = hash('SHA256', ($token));//Hash the key stored in the database, the normal value is sent to the user
		
        try {
			$stmt = $db->prepare("UPDATE members SET resetToken = :token, resetComplete='No' WHERE email = :email");
			$stmt->execute(array(
				':email' => $row['email'],
				':token' => $storedToken
			));
            
			//send email
			$to = $row['email'];
			$subject = "Password Reset";
			$body = "<p>You requested to reset your password.</p>
			<p>If this was a mistake, just ignore this email.</p>
			<p>To reset your password, click on the following link: <a href='".DIR."resetPassword.php?key=$token'>".DIR."resetPassword.php?key=$token</a></p>";
			$mail = new mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();
            
			//redirect to index page
			header('Location: login.php?action=reset');
			exit;
		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
	}
}

// $title = 'Reset Password';

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
							echo "<h2 class='bg-success'>Your account is now active you may now login.</h2>";
							break;
						case 'reset':
							echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
							break;
					}
				}
				?>
           <div class="forgotPsw-container">

               <p>Enter your Email to reset your Password</p>      
               <i class="fa fa-envelope icon" style="width: 8.8px"></i>
               <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" value=""  required >
               <input type="submit"  class="button" value="Reset Password" name="submit"  >
               <p><a href='login.php'>Back to login page</a></p>

           </div>
       </form>
       
   </div>
   
</body>
</html>
