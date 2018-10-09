<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>"Photo Upload"</title>
    </head>
    <body>
        <form action="fileupload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file" multiple/>
            <button type="submit" name="submit">UPLOAD</button>
        </form>
        <?php
           if(isset($_POST['submit']))
           {
               $file = $_FILES['file'];
               
               $fileName = $_FILES['file']['name'];
               $filetmp = $_FILES['file']['tmp'];
               $filesize = $_FILES['file']['size'];
               $fileerror = $_FILES['file']['error'];
               $filetype = $_FILES['file']['type'];
               
               $fileExt = explode('.',$fileName);
               $fileActualExt = strtolower(end($fileExt));
               
               $allowed = array('jpg', 'jpeg', 'png', 'pdf');
               
               if(in_array($fileActualExt, $allowed))
               {
                   if($fileerror === 0)
                   {
                       if($filesize < 1000000)
                       {
                           $filenewname = uniqid('', true).".".$fileActualExt;
                           $filedestination = 'uploads/'.$filenewname;
                           move_uploaded_file($filetmp, $filedestination);
                           header("Location: fileupload.php?uploadsuccess");
                       }
                       else
                       {
                           echo "Your file is too big";
                       }
                   }
                   else
                   {
                       echo " Error uploading";
                   }
               }
           }
        ?>
    </body>
</html>
