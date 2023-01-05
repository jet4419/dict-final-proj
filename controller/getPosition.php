<?php

include '../config/database.php';

// $_GET = json_decode(file_get_contents('php://input'), true);

// $empId = mysqli_real_escape_string($conn, $_POST['empId']);

$query = "SELECT employee.rank_id, ranking.position, COUNT(employee.rank_id) AS count 
          FROM employee 
          INNER JOIN ranking ON employee.rank_id = ranking.rank_id 
          GROUP BY employee.rank_id;";

$res = mysqli_query($conn, $query);
$empPosition = mysqli_fetch_all($res, MYSQLI_ASSOC);

$result = json_encode($empPosition);

echo $result;

$conn->close();


?>