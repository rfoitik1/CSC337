<?php
// Author: Richard Foitik and Mathieu Lancaster for CSC337 final project
//
class DatabaseAdaptor {
	// The instance variable used in every one of the functions in class DatbaseAdaptor
	private $DB;
	// Make a connection to an existing data based named 'login' that has
	// 2 tables . In this assignment you will also need a new table named 'users'
	public function __construct() {
		$db = 'mysql:dbname=dump;host=127.0.0.1';
		$user = 'root';
		$password = '';

		try {
			$this->DB = new PDO ( $db, $user, $password );
			$this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch ( PDOException $e ) {
			echo ('Error establishing Connection');
			exit ();
		}
	}
	
	//Function to load in all the quotes in the intro.php file.
	public function loadQuotes(){
		$stmt = $this->DB->prepare ("SELECT id, body, author, rating FROM quotes WHERE flagged = 0 ORDER by rating desc");
		$stmt->execute();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);		
	}
	
	public function flagAll(){
		$stmt = $this->DB->prepare ("UPDATE quotes set flagged=1");
		$stmt->execute();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);
	}
	
	public function unflagAll(){
		$stmt = $this->DB->prepare ("UPDATE quotes set flagged=0");
		$stmt->execute();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);
	}
	
	public function flagSingle($id){
		$stmt = $this->DB->prepare ("UPDATE quotes set flagged=1 WHERE id = '$id'");
		$stmt->execute();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);
	}
	
	public function checkUser($username){
		$stmt = $this->DB->prepare("SELECT * from user_login where username = :username");
		$stmt->bindParam('username', $username);
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
	//Create a user in the database.
	public function createUser($username, $f_name, $l_name, $hashed_pw, $email){
		$stmt = $this->DB->prepare ("INSERT INTO user_login (id, username, first_name, last_name, password, email) VALUES 
				('', :username, :f_name, :l_name, :password, :email)");
		$stmt->bindParam('username', $username);
		$stmt->bindParam('f_name', $f_name);
		$stmt->bindParam('l_name', $l_name);
		$stmt->bindParam('password', $hashed_pw);		
		$stmt->bindParam('email', $email);
		$stmt->execute ();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);
	}
	
	//Create a quote in the database.
	public function addQuote($quote, $author){
		$stmt = $this->DB->prepare ("INSERT INTO quotes (body, author, rating, flagged) VALUES (:quote, :author, 0, 0)");
		$stmt->bindParam('quote', $quote);
		$stmt->bindParam('author', $author);		
		$stmt->execute ();
		return $stmt->fetchAll (PDO::FETCH_ASSOC);
	}	
	
		
	//Function with PHP password hashing.
	public function userLogin2($username, $password){
		$hashed_pw = $this->DB->prepare ("SELECT password FROM user_login WHERE username = :userName");
		$hashed_pw->bindParam('userName', $username);
		$hashed_pw->execute ();
		$results = $hashed_pw->fetch();
		if(password_verify($password, $results['password'])){
			$stmt = $this->DB->prepare ("SELECT * FROM user_login WHERE username = :userName");
			$stmt->bindParam('userName', $username);
			$stmt->execute ();
			return $stmt->fetchAll ( PDO::FETCH_ASSOC );
		}else{
			return $stmt = [];
		}
						
	}
	
	public function ratingUp($id){
		$stmt = $this->DB->prepare("UPDATE quotes SET rating = rating + 1 WHERE id = '$id'");
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );		
	}
	
	public function ratingDown($id){
		$stmt = $this->DB->prepare("UPDATE quotes SET rating = rating - 1 WHERE id = '$id'");
		$stmt->execute ();
		return $stmt->fetchAll ( PDO::FETCH_ASSOC );
	}
	
} // End class DatabaseAdaptor

// Testing code that should not be run when a part of MVC
$theDBA = new DatabaseAdaptor ();
// $arr = $theDBA->getAllMoviesAfterYear (2000);
// print_r($arr);

?>