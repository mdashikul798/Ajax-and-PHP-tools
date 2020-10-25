<?php
$stuId = $_POST['id'];
$stuName = $_POST['student_name'];
$stuAge = $_POST['age'];

$conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

$sql = "UPDATE student SET student_name='{$stuName}', age='{$stuAge}' WHERE id={$stuId} ";
 
 if(mysqli_query($conn, $sql)){
     echo 1;
 }else{
     echo 0;
 }