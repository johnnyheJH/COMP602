<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
