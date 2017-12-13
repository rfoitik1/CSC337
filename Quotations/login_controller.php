<?php

// This controller acts as the go between the view and the model.
//
// Author Richard Foitik and Mathieu Lancaster for CSC337 final project
//
include 'model.php'; 

// for $theDBA, an instance of DataBaseAdaptor
$username = $_GET['username'];
$password = $_GET['password'];

$username = htmlspecialchars($username);
$password = htmlspecialchars($password);

$arr = $theDBA->userLogin2 ($username, $password);

if ($arr != NULL){
	session_start();
	$_SESSION['username'] = $username;
	
}
	
echo json_encode($arr);
	
	
?>