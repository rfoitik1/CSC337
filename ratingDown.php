<?php

// This controller acts as the go between the view and the model.
//
// Author Richard Foitik and Mathieu Lancaster for CSC337 final project
//
include 'model.php'; // for $theDBA, an instance of DataBaseAdaptor
$id = $_GET['id'];

$arr = $theDBA->ratingDown($id);
	echo json_encode($arr);
?>