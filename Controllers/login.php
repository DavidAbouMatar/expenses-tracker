<?php
	session_start();
	
	include("../config/connection.php");

	// check if sessions exist sent from signup page if exists use session
	if(isset($_SESSION['email']) && isset($_SESSION['password'])){
	
		$password = $_SESSION['password'];
		$email = $_SESSION['email'];
	}else{

		// if sessions doesnt exists use $_POST values
		if(isset($_POST["password"]) && $_POST["password"] != ""){
			
			$password = hash('sha256', $_POST['password']);

		}else{
			
			die("you cant hack it ;)");
		}

		if(isset($_POST["email"]) && $_POST["email"] != ""){
			$email = $_POST["email"];

		}else{
			die("you cant hack it ;)");
		}
	}




	$x = $connection->prepare("SELECT * FROM  users WHERE email = ? AND  password = ?");
	
	$x->bind_param("ss", $email, $password);
	
	$x->execute();
	$result= $x->get_result(); 
	$row = $result->fetch_assoc();
	// if $row has values redirect to home page
	if($row){


		// $_SESSION['title'] = $row["title"];
		$_SESSION['id'] = $row["id"];

	
		header("Location:../home.php");

	}else{
	// if $row is empty return to index page
	$x->close();
	$connection->close();
	header("Location:../index.html?error=Wrong email or password!");
	}
	
	
	
	

?>