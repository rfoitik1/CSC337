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
<title>Login</title>
</head>
<body>

<div id="toChange">

<div id="form">
<div id='labels'><label>Username: </label></div><div id='boxes'><input type="text" id="username"></div><br>
<div id='labels'><label>Password</label></div><div id='boxes'><input type="password" id="password"</div><br><br>
<button type="button" onclick="userLogin()">Login!</button>
</div>

</div>
<div class="loginPage">
<div id="login">
</div>

</div>

<script>
function userLogin() {
	var toChange = document.getElementById("toChange");
	var loginError = document.getElementById("login");
	var seconds = 2;
	var anObj = new XMLHttpRequest();
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;		
	anObj.open("GET", "login_controller.php?username=" + username + "&password=" + password, true);
	anObj.send();		

	anObj.onreadystatechange = function() {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);	
			var str = "";

			if (array.length > 0){
				str += "Welcome back, " + array[0]['username'] + "!";				
				toChange.innerHTML = str + "<br><br>" +
				"Page will redirect you in " + seconds + " seconds.";	
				setTimeout('redirect()');
								
			}else{
				
				loginError.innerHTML = "<br>" + "Username or password incorrect!";
				var username = document.getElementById("username").value = "";
				var password = document.getElementById("password").value = "";
			}		
			//this is what the JSON returns
			//[{"id":"21","username":"jim","first_name":"Jim","last_name":"Jones","password":"jim","visible":null,"email":"jimjones"}]
		
		}
	}
}

function logout(){
	window.location="logout.php";	
}

function redirect(){
	window.location.replace('intro.php');
	
}

</script>
</div>
</body>
</html>