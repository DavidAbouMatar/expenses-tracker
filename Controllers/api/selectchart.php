<?php
	include("../../config/connection.php");


$id = $_GET["id"];
// select c.name, SUM(e.amount) from categories as c LEFT JOIN expenses as e on c.id = e.category_id where c.user_id = 1 group by c.id
$query = " select c.name, SUM(e.amount) as amount from categories as c LEFT JOIN expenses as e on c.id = e.category_id where c.user_id = ? group by c.id";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$temp_array = [];
while($row = $result->fetch_assoc()){
    $temp_array[] = $row;

}

//print_r($temp_array);


$json = json_encode($temp_array, JSON_PRETTY_PRINT);
echo $json;
