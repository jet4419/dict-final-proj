<?php

include './config/database.php';

$empId = $_GET['empId'];
$sql="SELECT * FROM employee where id=" . $empId;
$result = mysqli_query($conn,$sql);

$var_array = array();

while($row = mysqli_fetch_assoc($result)){
    $var_array[] = $row;
}

echo json_encode($var_array);

// $_GET = json_decode(file_get_contents('php://input'), true);

// $empId = array(
//   'empId' => $_GET['empId']
// );



// echo $empId;

// $request_body = file_get_contents('php://input');

// $data = json_decode($request_body, true);

// $empId = $data['empId'];

// echo $empId;

// $sql="SELECT * FROM employee where id=" . $_POST["student_id"];

// $result = mysqli_query($conn,$sql);

// $var_array = array();

// while($row = mysqli_fetch_assoc($result)){
//     $var_array[] = $row;
// }

// header('Content-type:application/json');
// echo json_encode($empId);

mysqli_close($conn);

?>