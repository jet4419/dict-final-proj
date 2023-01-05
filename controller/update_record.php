<?php

include '../config/database.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$empId = mysqli_real_escape_string($conn, $_POST['empId']);
$empLastName = mysqli_real_escape_string($conn, $_POST['empLastName']);
$empFirstName = mysqli_real_escape_string($conn, $_POST['empFirstName']);
$empMiddleName = mysqli_real_escape_string($conn, $_POST['empMiddleName']);
$empSexId = mysqli_real_escape_string($conn, $_POST['empSexId']);
$empAddress = mysqli_real_escape_string($conn, $_POST['empAddress']);
$empPosId = mysqli_real_escape_string($conn, $_POST['empPosId']);

$sql="UPDATE employee SET last_name='$empLastName', first_name = '$empFirstName', middle_name = '$empMiddleName', 
      sex_id = '$empSexId', address = '$empAddress', rank_id = '$empPosId' 
      WHERE id=" . $empId;
$result = mysqli_query($conn,$sql);

if($conn->query($sql) === TRUE) {
  echo 'Record updated successfully!';
} else {
  echo "Error updating record: " . $conn->error;
}

// if ($conn->query($sql) === TRUE) {
//     // echo "Record updated successfully";
//     $query ="SELECT * FROM employee";

//     $result = mysqli_query($conn, $query);

//     $data = array();

//     while ($row = mysqli_fetch_assoc($result)) {
//       $data[] = $row;
//     }

//     $json = json_encode($data);

//     echo $json;

//   } else {
//     echo "Error updating record: " . $conn->error;
//   }
  
$conn->close();


?>