<?php
$stuId = $_POST['id'];

$conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

    $sql = "SELECT * FROM student WHERE id = {$stuId}";
    $result = mysqli_query($conn, $sql) or die('Query is faild');

    //Fatching data from database
    $output = '';
    if(mysqli_num_rows($result) > 0){
        
        while ($row = mysqli_fetch_assoc($result)) {
            $output = "
            <div class='form-group row'>
            <input type='text' class='form-control' hidden value='{$row["id"]}' id='updateId'>
                    
                <div class='col-md-6'>
                    <label for='name' class='col-sm-12 col-form-label'>Student Name</label>
                    <div class='col-sm-12'>
                        <input type='text' class='form-control' value='{$row["student_name"]}' id='st_name'>
                    </div>
                </div>

                <div class='col-md-6'>
                    <label for='age' class='col-sm-12 col-form-label'>Student Age</label>
                    <div class='col-sm-12'>
                        <input type='number' class='form-control' value='{$row["age"]}' id='st_age'>
                    </div>
                </div>
                <div class='form-group'>
                    <div class='col-md-12'>
                        <button type='submit' class='btn-outline-info' id='update-data' style='float:right;'>Update</button>
                    </div>
                </div>
            </div>
            ";
        }
        mysqli_close($conn);
        echo $output;
    }else{
        echo 'Record not found';
    }