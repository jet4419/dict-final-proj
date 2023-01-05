<?php

include '../config/database.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$empId = mysqli_real_escape_string($conn, $_POST['empId']);

$sql="DELETE FROM employee WHERE id = '$empId'";
$result = mysqli_query($conn, $sql);

if($conn->query($sql) === TRUE) {
  // echo 'Record deleted successfully!';
  $query = 'SELECT Employee.id, Employee.last_name, Employee.first_name, Employee.middle_name, Sex.gender, Employee.address, 
          Employee.rank_id, Ranking.position, Ranking.salary FROM Employee 
          INNER JOIN Ranking ON Ranking.rank_id = Employee.rank_id
          INNER JOIN Sex On Employee.sex_id = Sex.sex_id
          ORDER BY Employee.last_name, Employee.first_name, Employee.middle_name';
    $res = mysqli_query($conn, $query);
    $employees = mysqli_fetch_all($res, MYSQLI_ASSOC);

    echo json_encode($employees);

} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();


?>