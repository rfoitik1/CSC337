<?php
// This controller acts as the go between the view and the model.
//
// Author Richard Foitik and Mathieu Lancaster for CSC337 final project
//
include 'model.php';  // for $theDBA, an instance of DataBaseAdaptor

$username = $_GET['username'];
$f_name = $_GET['f_name'];
$l_name = $_GET['l_name'];
$password = $_GET['password'];
$email = $_GET['email'];


$username = htmlspecialchars($username);
$f_name = htmlspecialchars($f_name);
$l_name = htmlspecialchars($l_name);
$password = htmlspecialchars($password);
$email = htmlspecialchars($email);


$hashed_pw = password_hash($password, PASSWORD_DEFAULT);

$arr = $theDBA->createUser ($username, $f_name, $l_name, $hashed_pw, $email);
echo  json_encode($arr);


?>