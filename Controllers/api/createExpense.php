<?php

include("../../config/connection.php");

if(isset($_POST["amount"]) && $_POST["amount"] != ""){
    $amount = $_POST["amount"];


}else{
    die("you cant hack it amount ;)");
}

if(isset($_POST["date"]) && $_POST["date"] != ""){
    $date = $_POST["date"];


}else{
    die("you cant hack it date ;)");
}

if(isset($_POST["uid"]) && $_POST["uid"] != ""){
    $uid = $_POST["uid"];


}else{
    die("you cant hack it date ;)");
}

if(isset($_POST["category_id"]) && $_POST["category_id"] != ""){
    $category_id = $_POST["category_id"];


}else{
    die("you cant hack it date ;)");
}



$x = $connection->prepare("INSERT INTO `expenses` (`id`, `amount`, `date`, `user_id`, `category_id`) VALUES (NULL, ?, ?, ?, ?);");
	
$x->bind_param("ssss", $amount, $date,$uid,$category_id);

$x->execute();
$result = $x;

echo 'sucess';

?>