<?php 
session_start();
if(isset($_SESSION['username'])){
	
?>


<div class='usermenu'><?php echo "Logged in as: " . $_SESSION['username']?>

<button type="button" id="userbutton" onclick='flagAll()'>Flag All</button>
<button type="button" id="userbutton" onclick='unflagAll()'>Unflag All</button>
<button type="button" id="userbutton" onclick='logout()'>Logout</button>
</div><br>

<?php  }?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="styles.css">
<head>
<title>Quotations Service</title>
</head>
<!-- <h4>Quotations Services!</h4> -->
<body onload='loadQuotes()'>
<form id='quotes'>
</form>
<script>

function loadQuotes() {
	var anObj = new XMLHttpRequest();		
	anObj.open("GET", "intro_controller.php", true);
	anObj.send();	
	var form = document.getElementById("quotes");

	anObj.onreadystatechange = function() {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);	
			var str = "";

			for (i = 0; i < array.length; i++){
				str += "<fieldset>Quote: " + "'" + array[i]['body'] + "'" + "<br><br>" +
				"Author: " + array[i]['author'] + "<br><br>" +
				"<button type='button' onclick='ratingDown("+ array[i]['id'] +")'> - </button> &nbsp" +
				array[i]['rating'] + "&nbsp <button type='button' onclick='ratingUp("+ array[i]['id'] +")'> + </button> &nbsp" +
				"<button type='button' onclick='flag("+ array[i]['id'] +")'>Flag</button></fieldset>";				
				
			}form.innerHTML = str;
		}
	}
}
function logout(){
	window.location="logout.php";
}

function flagAll(){		
	var anObj = new XMLHttpRequest();		
	anObj.open("GET", "flagAll.php?", true);
	anObj.send();
	loadQuotes();
	location.reload();
}

function unflagAll(){	
	var anObj = new XMLHttpRequest();		
	anObj.open("GET", "unflagAll.php", true);
	anObj.send();
	loadQuotes();
	location.reload();
	
}

function ratingUp(i){
	var anObj = new XMLHttpRequest();
	var id = i;	
	anObj.open("GET", "ratingUp.php?id=" + id, true);
	anObj.send();
	loadQuotes();	
	
}

function ratingDown(i){
	var anObj = new XMLHttpRequest();
	var id = i;	
	anObj.open("GET", "ratingDown.php?id=" + id, true);
	anObj.send();
	loadQuotes();
		
}

function flag(i){
	var anObj = new XMLHttpRequest();
	var id = i;	
	anObj.open("GET", "flag.php?id=" + id, true);
	anObj.send();
	loadQuotes();
	location.reload();	
}

</script>
</body>
</html>

