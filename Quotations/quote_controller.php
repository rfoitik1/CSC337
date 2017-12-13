<?php
// This controller acts as the go between the view and the model.
//
// Author Richard Foitik and Mathieu Lancaster for CSC337 final project
//
include 'model.php';  // for $theDBA, an instance of DataBaseAdaptor
$quote = $_GET['quote'];
$author = $_GET['author'];

$quote = htmlspecialchars($quote);
$author = htmlspecialchars($author);


$arr = $theDBA->addQuote ($quote, $author);
echo  json_encode($arr);
?>