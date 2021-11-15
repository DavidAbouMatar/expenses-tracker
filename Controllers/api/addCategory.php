<?php

include("../../config/connection.php");

if(isset($_POST["name"]) && $_POST["name"] != ""){
    $name = $_POST["name"];


}else{
    die("you cant hack it name ;)");
}
if(isset($_POST["userID"]) && $_POST["userID"] != ""){
    $userID = $_POST["userID"];


}else{
    die("you cant hack it user ;)");
}




$x = $connection->prepare("INSERT INTO `categories` (`id`, `name`, `user_id`) VALUES (NULL, ?, ?);");
	
$x->bind_param("ss", $name, $userID);

$x->execute();
$result = $x;

echo 'sucess';

?>