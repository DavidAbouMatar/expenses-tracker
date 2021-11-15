<?php
	include("../../config/connection.php");


$id = $_GET["id"];

$query = "SELECT * FROM categories as c left join expenses as e on c.id = e.category_id  WHERE e.user_id=? ";
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
