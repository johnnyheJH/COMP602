<?php

if (isset($_POST['submit'])){
    
    include_once 'dbh-inc.php';
    
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']); 
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']); 
    
    //Error handlers
    //Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($email) || 
        empty($password)) {
        header("Location: ../signup.php?signup=empty");
        exit();
        
    } else {
        // Check if input characters are valid
        if (!preg_match("/^[a-zA-z]*$/", $first_name) || 
            !preg_match("/^[a-zA-z]*$/", $last_name )) 
            {
             header("Location: ../signup.php?signup=invalid");
             exit();
        } else {
            //Check if email is valid
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) 
            {
                header("Location: ../signup.php?signup=invalid-email");
                exit();
            }
            else 
            {
                $sql = "SELECT * users WHERE users_email='$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if ($resultCheck > 0)
                {
                    header("Location: ../signup.php?signup=email-taken");
                    exit();
                } else {
                    //Hasing the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (users_first_name, users_last_name, 
                         users_email, users_password) VALUES ('$first_name',
                         '$last_name', '$email', '$hashedPassword');";
                    mysqli_query($conn, $sql);
                    
                    header("Location: ../signup.php?signup=success");
                    exit();
                    
                }
                
            }
        }
    }
    
    
    
} else {
    header("Location: ../signup.php");
    exit();
}


