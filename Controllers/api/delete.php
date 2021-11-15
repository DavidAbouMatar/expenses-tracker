<?php

include("../../config/connection.php");

if(isset($_POST["uid"]) && $_POST["uid"] != ""){
    $id = $_POST["uid"];


}else{
    die("you cant hack it email ;)");
}




$x = $connection->prepare("delete from expenses where id=?");
	
$x->bind_param("i", $id);

$x->execute();
$result = $x;

echo 'sucess';

?>