<?php
	session_start();
	
	include("../config/connection.php");

	
	if(isset($_POST["name"]) && $_POST["name"] != ""){
		$name = $_POST["name"];
	

	}else{
		die("you cant hack it ;)");
	}

	if(isset($_POST["password"]) && $_POST["password"] != ""){

		$password = hash('sha256', $_POST['password']);
		$password1 =$_POST["password"];
	}else{
	
		die("you cant hack it :)");
	}

	if(isset($_POST["email"]) && $_POST["email"] != ""){
		$email = $_POST["email"];

	}else{
		die("you cant hack it ;)");
	}

	if(isset($_POST["last_name"]) && $_POST["last_name"] != ""){
		$last_name= $_POST["last_name"];

	}else{
		die("you cant hack it ;)");
	}




	
	$x = $connection->prepare("INSERT INTO users ( name, email,last_name, password) VALUES (?, ? , ?, ?)");
	
	$x->bind_param("ssss",$name,$email, $last_name, $password);
	
	$x->execute();
	$result = $x;
	//if query is executed seccefully affected_rows = 1 else its -1
	if($result->affected_rows > 0){
		$_SESSION['email'] = $email;
		$_SESSION['password'] = $password;
	
	
		$x->close();
		$connection->close();
		header("Location:../home.php");
		}else{
			
		$x->close();
		$connection->close();
		header("Location:signup.html?error=Email already exists!");
	}


?>