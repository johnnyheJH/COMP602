# COMP602
For team project of Software Development Practice

	*****  UNISHARE  *****



  **  Overview  **

UniShare is an online/cloud-based text book sharing application aimed at providing a platform for both current and ex-tertiary students a place to buy and sell used or new text books.
This is currently only available to New Zealand Universities (2018) however we do plan to expand to the global market. 

Files (22/10/2018 @ 3:28pm): 

	style (directory)
	img (directory)
	includes (directory)
	classes (directory)
	
		adding_book.php 
		background.png
		add_explore_search.php
		fileupload.php  
		resetPassword.php 
		reset.php
		index.php 
		listing_page.php
		listing.txt 
		memberpage.php 
		profilePage.php 
		login.php 
		logout.php
		search-page.php  
		searchPage.html  
		activate.php 
		addBook.php 
		userTest.php 
		usersdatabase.txt 
		

For a full description of the web page please email unisharee@gmail.com with the subject line "MOREINFO"

To submit feature suggestions, or to track changes please email unisharee@gmail.com with the subject line "FEATURES"

  **  Requirements  **

UniShare is cloud-based so that means there is no need to install!! As long as you have an internet connection and any reliable web browser (however we do reccommend Google Chrome)
then you are all set to use UniShare!

Recommended:

500MHz Processor
128MB RAM
Google Chrome

  **  Motivation  **

Being Tertiary students ourselves we understand the difficulties one can face in order to purchase that much needed text book. We decided why not build a platform for 
students to meet and trade! 

  **  Build  **

		Build Status - Release 1.0
		Build Language(s) - PHP (Backend), HTML/CSS (Frontend), MySQL (Database)
		Code Style - Standard PHP, HTML and CSS packages

  **  Code Example  **

	<!DOCTYPE html>

	<?php

	mysqli_connect("localhost", "my_user", "my_password", "my_db");


	if(mysqli_connect_errno())

	{

    	echo "Failed to connect to MySQL: " . mysqli_connect_error();

	}

	?>

	<html>

    	<head>

        	<meta charset="UTF-8">

        	<title>"Photo Upload"</title>

    	</head>

    	<body>

        	<form action="upload.php" method="post" enctype="multipart/form-data">

            	<input type="file" name="file_img[]" multiple/>

            	<input type="submit" name="btn_upload" value="Upload">

        	</form>

        	<?php

            	if(isset($_POST['btn_upload']))

            	{

                	for($i = 0; $i<count($_FILES["file_img"]["name"]);$i++)

                	{

                   	$filetmp = $_FILES["file_img"]["tmp_name"][$i]; 

                   	$filename = $_FILES["file_img"]["name"][$i];

                   	$filetype = $_FILES["file_img"]["type"][$i];

                   	$filepath = "photo/".$filename;

                   

                   	move_uploaded_file($filetmp, $filepath);

                   

                   	$sql = "INSERT INTO upload_img (img_name, img_path, img_type) VALUES('$filename', '$filepath', '$filetype')";

                   	$result = mysqli_query($sql);

                	}

            	}

        	?>

    	</body>

	</html>

<<< Standard HTML syntax and style >>> this is also true for the other 2 languages used to implement UniShare

  ** Features  **

Login/Sign up 
Ability to list an item to sell
Ablility to view listing for sale

  **  Maintainers  **  

Johnny He - johnnyheJH
Noah Te Ao - noahteao
Fahad - alajmi771
Ming - MadHead34
Lolo Saulala - AchillesShadow

  **  Contribute  **

If you would like to help contribute to the project in anyway please feel free to email unisharee@gmail.com with the subject line "DEVTEAM RECRUIT" with your name and also any contact details
other than email

  **  Credits  **

AUT Computer and Information Science Faculty
Barry (Badger) Dowdeswell
Sheetal Datt - Supervisor
UniShare Development Team
GitHub

  **  Trouble Shooting **

If you encounter any bugs or run-time errors please email unisharee@gmail.com with the subject line "BUG URGENT" and describe where on the website you encountered and the bug
and what issues resulted from the bug.
