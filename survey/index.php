<?php
session_start();
require('includes/sessionCheck.php');
/*
The following is completed:
 - user can start survey by entering email.
 |-> if the email syntax is wrong: redirect to index with error message
 |-> the email will generate an id by md5 encryption (will be checked with DB once added)
 - if a page is not set it will set it to 1 (will be checked with DB once added)

Add later:
 - if a session is already found of email and or id, check with database and display a page on index telling the user they can either continue their progress or restart
 - if a user already has done some progress on the survey, lost their session and enters their email on the index: display a page on index telling the user they can either continue their progress or restart
 - if you complete page 1 and press 'Neste spørsmål', 1 will be added to the session variable 'page' and you will be redirecting back and get content from page 2

Bugs:
 - 'http://localhost/survey/verify.php?email=aleksanderhaugmo%40hotmail.com&submit=Ta+unders%C3%B8kelsen' doesn't send you to the survey.. But without the submit variable it works..
*/

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
				<h1>Her kan du delta i vår spørreundersøkelse</h1>
			</div>
		<div class="row survey">
			<form action="verify.php">
				Skriv inn din epost adresse:<br>
				<input class="textField textFieldEmail" name="email" type="text" maxlength="256" autocomplete="on" placeholder="eksempel@domene.no">
				<?php sessionCheckIndex("errormsg");?>
				<br><input style="float: left;" class="submitButton" name="submit" type="submit" value="Ta undersøkelsen"><br><br>
				<div class="footer">
					<span>Varighet: 40 minutter&nbsp;&nbsp;|&nbsp;&nbsp;30 Spørsmål</span>
				</div>
			</form>
		</div>
		<div class="row filler">
		
		</div>
	</div>
</div>

</body>
</html>