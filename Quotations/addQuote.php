<?php 
session_start();
if(isset($_SESSION['username'])){	
?><div class='usermenu'><?php echo "Logged in as: " . $_SESSION['username']?>
<button type="button" id="userbutton" onclick='logout()'>Logout</button>
</div><br>
<?php }?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="styles.css">
<head>
<meta charset="ISO-8859-1">
<title>Add Quote</title>
</head>
<body>
<div id="toChange">
<form>
Quote: <br>
<textarea name="quote" id="quote" cols="60" rows="6" placeholder="Insert your quote here"></textarea><br><br>
Author: <br>
<textarea name="author" id="author" cols="40" rows="2" placeholder="Insert the author here"></textarea><br>
<button type="button" onclick="createQuote()">Add Quote!</button><br><br>
<div class="loginPage">
<div id="login">
</div>

</div>

</form>
</div>
<script>
function createQuote() {
	var divToChange = document.getElementById("toChange");
	var anObj = new XMLHttpRequest();
	var error = document.getElementById("login");
	var quote = document.getElementById("quote").value;
	var author = document.getElementById("author").value;	
	if (quote == "" || author == ""){
		error.innerHTML = "<br>" + "Please make sure you fill out both fields!";
	}else{	
	anObj.open("GET", "quote_controller.php?quote=" + quote + "&author=" + author, true);
	anObj.send();		

	divToChange.innerHTML = "Thanks for adding the quote! <br> " +
	"Page will redirect you in 2 seconds.";	
	setTimeout('redirect()');
	}
}

function logout(){
	window.location="logout.php";
	
}

function redirect(){
	window.location.replace('intro.php');
	
}
</script>
</body>
</html>