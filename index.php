


<?php
 $conn = new mysqli("localhost","root","","my_db"); 

 if(isset($_POST['submit'])) {
    $post = $_POST['post'];
    $query =  "INSERT INTO table_one (post) VALUES ('$post')";
    $conn->query($query);

    }

// needs work on file uploading... 

    if(isset($_POST['submitUpload'])) {
        $file=$_FILES['file'];
        $fileTmp=$_FILES['file']['tmp_name'];
        $fileName=$_FILES['file']['name'];
        $folder = "images/".$fileName;

        echo "<div class='file' style='color:white;'>".$fileName." <div>";
        $sql = "INSERT INTO table_one (uploadfile) VALUES ('$fileName')"; 
        $conn->query($sql);

        if (move_uploaded_file($fileTmp, $folder))  { 
            echo "Image uploaded successfully"; 
        }else{ 
           echo  "Failed to upload image"; 
        } 


    }




if(isset($_POST['update'])) {
    $postToEdit = $_POST['postToEdit'];
    $the_id = $_POST['the_id'];
     $query =  "UPDATE table_one SET post='$postToEdit' WHERE id='$the_id' ";
    $conn->query($query);

   
}

 


if(isset($_POST['delete'])) {

    $the_id = $_POST['the_id'];
    $query = "DELETE FROM table_one WHERE id = '$the_id'";
    $conn->query($query);

    $sql = "SELECT * FROM table_one ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

}


 ?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project at mothers</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    








<div class="landing">
    
<form class='submitForm' action='index.php' method='post' enctype="multipart/form-data">
    <h2>Type new post here </h2>
    <input type='text' class='mainInputPost' name='post' >
    <input type="submit" class='submitBtn' value="submit" name='submit'>
   
</form>

<form action='#' method='post' enctype="multipart/form-data">
<input type="file" class='file'  name='file'>    

<input type="submit" class='submitUploadPic' value="submit" name='submitUpload'>

</form>







<?php


 

  



$sql = "SELECT * FROM table_one ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


while($row = $result->fetch_assoc()) {
  echo "<div class='row'>
        <p >".$row['post']."</p>

        <form class='deleteForm' action='#' method='post'>
            <input type='hidden' name='the_id' value='".$row['id']."'>
            <button type='submit' name='delete' class='deleteBtn'>Delete</button>
            <button type='button' class='editBtn'>EDIT</button>
        </form>

        <img src='./images/".$row['uploadfile']." '>
        ".$row['uploadfile']."
       

        <form class='updateForm' action='#' method='post'>
            <input type='hidden' name='the_id' value='".$row['id']."'>
            <input type='text' class='postToEdit' name='postToEdit' value='".$row['post']."'>
            <button type='submit' name='update' class='updateBtn' >Update</button>
        </form>
    </div><br>
    
    
    ";
}

   ?>





</div>









        <!-- JAVASCRIPT -->
            <script>

            const editBtn = document.querySelectorAll('.editBtn');
            const updateForm = document.querySelectorAll('.updateForm');

            for(let i =0; i < editBtn.length; i++) {

                editBtn[i].addEventListener('click', (e) => {
                e.preventDefault()
                if(updateForm[i].style.display =='block'){
                    updateForm[i].style.display='none';
                }else{
                updateForm[i].style.display='block';
                }

            })

            }


            </script>






</body>
</html>
