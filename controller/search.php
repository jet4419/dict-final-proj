<?php

include '../config/database.php';

// $_GET = json_decode(file_get_contents('php://input'), true);

// $empId = mysqli_real_escape_string($conn, $_POST['empId']);
$searchStr = mysqli_real_escape_string($conn, $_GET["searchStr"]);

$query = "SELECT employee.id, employee.last_name, employee.first_name, employee.middle_name, sex.gender, employee.address, 
          employee.rank_id, ranking.position, ranking.salary FROM Employee 
          INNER JOIN Ranking ON ranking.rank_id = employee.rank_id
          INNER JOIN Sex On employee.sex_id = sex.sex_id
          WHERE CONCAT(employee.id, employee.last_name, employee.first_name, employee.middle_name, sex.gender, employee.address, 
          employee.rank_id, ranking.position, ranking.salary)
          LIKE '%$searchStr%'
          ORDER BY employee.last_name, employee.first_name, employee.middle_name";
$res = mysqli_query($conn, $query);
$employees = mysqli_fetch_all($res, MYSQLI_ASSOC);

// $res = mysqli_query($conn, $query);
// $empPosition = mysqli_fetch_all($res, MYSQLI_ASSOC);

// $result = json_encode($empPosition);

echo json_encode($employees);
// echo $searchStr;

$conn->close();


?>