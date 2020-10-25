<?php
$conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

$limit_per_page = 3;
$page = '';
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else{
    $page = 1;
}
$offset = ($page - 1) * $limit_per_page;

$sql = "SELECT * FROM student LIMIT {$offset}, {$limit_per_page}";
$result = mysqli_query($conn, $sql) or die('Query is faild');

//Fatching data from database
$output = '';
if(mysqli_num_rows($result) > 0){
    $output = '
    <table class="table" id="page-data">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Student Name</th>
            <th scope="col">Age</th>
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
                <td><button class='btn-warning' data-eid='{$row["id"]}' id='edit-item'>Edit</button></td>
                <td><button class='btn-danger' data-id='{$row["id"]}' id='delete-item'>Delete</button></td>
            </tr>";
            $stNum ++;
    }
    
    $output .= "</table>";

    $sql_total = "SELECT * FROM student";
    $records = mysqli_query($conn, $sql) or die('Query is faild');
    $total_record = mysqli_num_rows($records);
    $total_page = ceil($total_record / $limit_per_page);

    $output .= '
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>';
    for($i=1; $i<=$total_page; $i++){
        $output .= "<li class='page-item'><a class='page-link' id='{$i}' href=''>{$i}</a></li>";
    }
    $output .= '
    <li class="page-item">
        <a class="page-link" href="#">Next</a>
    </li>
    </ul>
    </nav>';
    
   
    
    echo $output;
}else{
    echo 'Record not found';
}

// End of fatching data from database