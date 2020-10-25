<?php
    
    $conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

    $sql = 'SELECT distinct(city) FROM student';
    $result = mysqli_query($conn, $sql) or die('Query is faild');

    //Fatching data from database
    $output = '';
    if(mysqli_num_rows($result) > 0){
        $output = mysqli_fetch_all($result,MYSQLI_ASSOC);
        echo json_encode($output);

        
    }else{
        echo 'Record not found';
    }
    // End of fatching data from database    