<?php
    
    $conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

    $citys = $_POST['city'];

$sql = "SELECT * FROM student WHERE city = '{$citys}'";
    $result = mysqli_query($conn, $sql) or die('Query is faild');

    //Fatching data from database
    $output = '';
    if(mysqli_num_rows($result) > 0){
        $output = '
            <thead>
                <tr>
                <th scope="col">SL</th>
                <th scope="col">Student Name</th>
                <th scope="col">Age</th>
                <th scope="col">City</th>
                <th>Edit</th>
                <th>Delete</th>
                </tr>
            </thead>';
        $stNum = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "
                <tr>
                    <th scope='row'>{$stNum}</th>
                    <td>{$row["student_name"]}</td>
                    <td>{$row["age"]}</td>
                    <td>{$row["city"]}</td>
                    <td><button class='btn-warning' data-eid='{$row["id"]}' id='edit-item'>Edit</button></td>
                    <td><button class='btn-danger' data-id='{$row["id"]}' id='delete-item'>Delete</button></td>
                </tr>";
                $stNum ++;
        }
        mysqli_close($conn);
        echo $output;
    }else{
        echo 'Record not found';
    }
    // End of fatching data from database    