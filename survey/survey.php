<?php
session_start();
//include('includes/urlParameters.php');
// Array keeps track of checked variables
// NULL = not checked | 1 = is set | 2 = is not set
//$status = array(
//		"id"	=>	NULL,
//		"page"	=>	NULL
//);
// Calling function from 'urlParameters.php'
//$status = checkURL($status);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Salten Kraftsamband - Spørreundersøkelse</title>
	<link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>

<div class="container">
	<div class="formContainer">
		<div class="row header">
			<a href="http://sks.no" target="_blank">
				<img alt="logo" src="img/logo.png">
			</a>
			<div class="surveyTitle">Spørreundersøkelse</div>
		</div>
		<div class="row question">
				<h1>1. Hva er ditt kjønn?</h1>
			</div>
		<div class="row survey">
			<form action="verify.php">
				
				<input class="radioButton" name="1" type="radio" value="mann" checked>
				<label class="radioLabel" for="mann">Mann</label><br>
				
				<input class="radioButton" name="1" type="radio" value="kvinne">
				<label class="radioLabel" for="mann">Kvinne</label><br>
				
				<input class="radioButton" name="1" type="radio" value="annet">
				<label class="radioLabel" for="mann">Annet</label>
				<input class="submitButton" name="submit" type="submit" value="Neste spørsmål">
				<div class="footer">
					<span>Varighet: 40 minutter&nbsp;&nbsp;|&nbsp;&nbsp;Spørsmål 1/30</span>
				</div>
			</form>
		</div>
		<div class="row filler">
		
		</div>
	</div>
</div>

</body>
</html>