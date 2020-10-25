<?php

   $stuId = $_POST['id'];

   $conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

    $sql = "DELETE FROM student WHERE id = {$stuId}";
    
    if(mysqli_query($conn, $sql)){
        echo 1;
    }else{
        echo 0;
    }