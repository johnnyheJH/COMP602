<?php

if (isset($_POST['signup'])){
    
    include_once 'dbh-inc.php';
    
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    $confirm_psw = mysqli_real_escape_string($conn, $_POST['confirm_psw']);
    
    //Error handlers
    //Check for empty fields
    if (empty($full_name) || empty($confirm_psw) || empty($email) || 
        empty($password)) {
        header("Location: ../signupPage.html?signup=empty");
        exit();
        
    } else {
        // Check if input characters are valid
        if (!preg_match("/^[a-zA-z]*$/", $full_name))
            {
             header("Location: ../signUpPage.html?signup=invalid");
             exit();
        } else {
            //Check if email is valid
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
            {
                header("Location: ../signupPage.html?signup=invalid-email");
                exit();
            }
            else 
            {
                $sql = "SELECT * users WHERE users_email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0)
                {
                    header("Location: ../signupPage.html?signup=email-taken");
                    exit();
                } else {
                    //Checking if passwords match
                    if ($password == $confirm_psw) {
                    //Hasing the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (users_full_name, 
                         users_email, users_password) VALUES ('$full_name',
                          '$email', '$hashedPassword');";
                    mysqli_query($conn, $sql);
                    
                    header("Location: ../index.html?signup=success");
                    exit();
                    
                } else {
                       echo "Password doesn't match! "; 
                    }
                
            }
     }
    }
  }
} else {
        header("Location: ../signUpPage.html?error=unknown");
        exit();

    }
            

