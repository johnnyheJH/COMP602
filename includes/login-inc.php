<?php

session_start();

if (isset($_POST['login'])) 
    {
    
    include 'dbh-inc.php';
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    //Error Handlers
    //Check if inputs are empty
    if (empty($email) || empty($password))
    {
        
    }else {
        $sql = "SELECT * FROM users WHERE users_email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        if ($resultCheck < 1)
        {
            header("Location: ../index.html?login=error");
            exit();
        } else{
            if ($row = mysqli_fetch_assoc($result))
            {
                //De-hasing the password
                $hasedPasswordCheck = password_verify($password, $row['users_password']);
                if ($hasedPasswordCheck == FALSE){
                    header("Location: ../index.html?login=error");
                    exit();
                } else if ($hasedPasswordCheck == TRUE)
                {
                    //Log in the user here
                    $_SESSION['u_id'] = $row['users_id'];
                    $_SESSION['u_full_name'] = $row['users_full_name'];
                    $_SESSION['u_email'] = $row['users_email'];
                    header("Location: ../choosingATool.html?login=success");
                    exit();
                }
                
                
            }
        }
        
        }
    }
else 
    {
      header("Location: ../index.html?login=error");
      exit();
    }
