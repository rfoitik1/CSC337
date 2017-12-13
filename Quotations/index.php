<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<meta charset="ISO-8859-1">
<title>Quotation Services!</title>
</head>
<h1>Quotes</h1>
<body>
<div id='buttons'>

<div id='button'><button type="button" id="select" onclick="setFrameTo(0)">
Home
</button></div>

<div id='button'><button type="button"  id="select" onclick="setFrameTo(1)">
Register
</button></div>

<div id='button'><button type="button"  id="select" onclick="setFrameTo(2)">
Login
</button></div>

<div id='button'><button type="button"  id="select" onclick="setFrameTo(3)">
Add Quote
</button></div>

</div>
<br><br>
<div id='iframe'>
<iframe id="section" src="intro.php">
</iframe>
<script>
var logged_in = false; //for global variable if logged in, we use session
var x = [];
x[0] = "intro.php";
x[1] = "register.php";
x[2] = "login.php";
x[3] = "addQuote.php";


function setFrameTo(number) {
var frame = document.getElementById("section");
frame.src = x[number];
}


</script>
</div>

</body>
</html>
