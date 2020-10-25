<?php
    $name = $_POST['st_name'];
    $age = $_POST['st_age'];

    $conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');
    $sql = "INSERT INTO student(student_name, age)
VALUES ('{$name}', '{$age}')";

    if (mysqli_query($conn, $sql)) {
        echo 1;
      } else {
        echo 0;
      }
      
    