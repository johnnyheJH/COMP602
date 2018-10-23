<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UniShare</title>
   <link rel="stylesheet" href="style/profile_page_style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
   
   <script type="text/javascript">
    
    function saveEdits() {

        //get the editable element
        var editElem2 = document.getElementById("nameEdit");
        var editElem = document.getElementById("edit");
        

        //get the edited element content
        var userVersion2 = editElem2.innerHTML;
        var userVersion = editElem.innerHTML;
        

        //save the content to local storage
        localStorage.userEdits2 = userVersion2;
        localStorage.userEdits = userVersion;
        

        //write a confirmation to the user
        document.getElementById("update").innerHTML="Edits saved!";

    }
       
    function checkEdits() {

        //find out if the user has previously saved edits
        if(localStorage.userEdits!=null)
            document.getElementById("nameEdit").innerHTML = localStorage.userEdits2;
            document.getElementById("edit").innerHTML = localStorage.userEdits;
        
     }
    
    
    </script>
</head>
<body background="background.png" onload="checkEdits()">

  <header>
    <img src="img/Logo.png" alt="logo" class="logo">
  </header>
  
  
  <div class="avatar">   
      <img src="img/avatar.png" alt="">
  </div>
  
  <div class="userName">
      <h2>  </h2>
  </div>
  
  <lable>Username</lable>
      <div id="nameEdit" contenteditable="true">
       Team Crescent
      </div>
  
  
  <lable>Description</lable>
  <div id="edit" contenteditable="true">
   Click here to add Edit Description
  </div>
    
 <input  class="save" type="button"  value="Save" onclick="saveEdits()"/>

  <input type="button" value="Change Password" name="changePsw" href=>



</body>
</html>