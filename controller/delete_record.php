<?php

include '../config/database.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$empId = mysqli_real_escape_string($conn, $_POST['empId']);

$sql="DELETE FROM employee WHERE id = '$empId'";
$result = mysqli_query($conn,$sql);

if($conn->query($sql) === TRUE) {
  echo 'Record deleted successfully!';
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();


?>