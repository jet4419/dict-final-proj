<?php

include '../config/database.php';

// $_GET = json_decode(file_get_contents('php://input'), true);

// $empId = mysqli_real_escape_string($conn, $_POST['empId']);

$query = "SELECT employee.sex_id, sex.gender, COUNT(employee.sex_id) AS count 
        FROM employee 
        INNER JOIN sex ON sex.sex_id = employee.sex_id 
        GROUP BY employee.sex_id;";

$res = mysqli_query($conn, $query);
$gender = mysqli_fetch_all($res, MYSQLI_ASSOC);

$result = json_encode($gender);

echo $result;

$conn->close();


?>