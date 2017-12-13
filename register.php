<?php 
session_start();
if(isset($_SESSION['username'])){	
?><div class='usermenu'><?php echo "Logged in as: " . $_SESSION['username']?>
<button type="button" id="userbutton" onclick='logout()'>Logout</button>
</div><br>
<?php }?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<meta charset="ISO-8859-1">
<title>Register</title>
</head>
<body>
<div id="toChange">
<strong>Register </strong>with us to have access to all our features! <br>
We promise to sell your information to the highest bidder!
<br><br>
<form autocomplete="off">
<strong>Your Information:</strong><br>
<div id='labels'><label>First Name: </label></div> <div id='boxes'><input type="text" id="first_name""></div><br>

<div id='labels'><label>Last Name:</label> </div><div id='boxes'><input type="text" id="last_name""></div><br>

<div id='labels'><label>Email: </label></div><div id='boxes'><input type="text" id="email" required></div><br><br>


<strong>Website Information: </strong><br>
<div id='labels'><label>Username: </label></div><div id='boxes'><input type="text" id="username""></div><br>

<div id='labels'><label>Password</label></div><div id='boxes'><input type="password" id="password"</div><br><br><br>


<button type="button" onclick="checkForm()">Register!</button>
<div id="regError">
</div>
</div>
</form>
</div>
<script>		
function checkForm(){	
	var error = document.getElementById("regError");
	var username = document.getElementById("username").value;
	var f_name = document.getElementById("first_name").value;
	var l_name = document.getElementById("last_name").value;
	var password = document.getElementById("password").value;
	var email = document.getElementById("email").value;	
	if (username == "" || f_name == "" || l_name == "" || email == "" || password == ""){
		error.innerHTML = "<br> Please make sure all entries are filled!";	
		return false;
	}else if(username.length < 4){
		error.innerHTML = "<br> Username must be at least 4 characters long!";
		return false;
	}else if(password.length < 6){
		error.innerHTML = "<br> Password must be at least 6 characters long!";
		return false;	
	}
	error.innerHTML = "";	
	checkUsers();
}

function checkUsers(){
	var username = document.getElementById("username").value;
	var anObj = new XMLHttpRequest();
	var reg = document.getElementById("regError");
	anObj.open("GET", "check_users_controller.php?username=" + username, true);
	anObj.send();	
		
	anObj.onreadystatechange = function() {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);	
			var str = "";				
			if (array.length > 0){
				str += "<br> The username has already been taken!";	
				var username = document.getElementById("username").value = "";			
				reg.innerHTML = str + "<br><br>";		
				return;	
			}else {
				createUser();
			}			
		}		
	}
}

function createUser() {
	var username = document.getElementById("username").value;
	var f_name = document.getElementById("first_name").value;
	var l_name = document.getElementById("last_name").value;
	var password = document.getElementById("password").value;
	var email = document.getElementById("email").value;	
	var divToChange = document.getElementById("toChange");	
	var anObj = new XMLHttpRequest();	

	anObj.open("GET", "user_controller2.php?username=" + username + "&f_name=" + f_name +
			"&l_name=" + l_name + "&password=" + password + "&email=" + email, true);
			anObj.send();		

	divToChange.innerHTML = "Thanks for registering, " + username + "!<br><br>" +
	"Page will redirect you in 2 seconds.";	
	setTimeout('redirect()');	
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