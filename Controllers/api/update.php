<?php

	session_start();
	
	include("../../config/connection.php");

	//check data posted if exists
	if(isset($_POST["amount"]) && $_POST["amount"] != ""){
		$amount = $_POST["amount"];
	

	}else{
		die("you cant hack it email ;)");
	}

	if(isset($_POST["date"]) && $_POST["date"] != ""){
		$date= $_POST["date"];

	}else{
		die("you cant hack it lastname ;)");
	}
    if(isset($_POST["uid"]) && $_POST["uid"] != ""){
		$uid = $_POST["uid"];
	

	}else{
        die("you cant hack it lastname ;)");
	}

	

	
	




            
        $x = $connection->prepare("update expenses set amount=?,date=? where id=?");
        $x->bind_param("sss", $amount, $date, $uid);
        $x->execute();
        $result = $x;
		echo "success";

      
  
	


	
	

?>