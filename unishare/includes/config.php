<?php

ob_start();
session_start();

//set timezone
date_default_timezone_set('Pacific/Auckland');


//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
define('DBNAME','unishare');

//application address
define('DIR','http://localhost:8888/unishare/');
define('SITEEMAIL','unisharee@gmail.com');

try {
    
	//create PDO connection to connect DB
	$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');

$user = new User($db); 
?>