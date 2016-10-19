<?php
session_start();
// error #999 : email was found in url. When checking session ID, the email from url was not added to a session..
// error #998 : email was added to a session but the syntax was not correct?! Tip: Find the code where the url email is checked for syntax and with the database.
checkEmail();

function debug($text){
	$debugging = true; // enable debugging: (true/false)
	if ($debugging === true){
		echo "Debugging: $text <br>";
	}
}

// REMEBER: ADD DATABASE CHECK FUNCTION IF THE URL OR SESSION EMAIL ALREADY EXISTS IN THE DATABASE!
// REMEBER: ADD A CHECK ON THE URL EMAIL TO SEE IF IT IS EMPTY.
// REMEMBER: ADD FUNCTION FOR WHEN THE SESSION EMAIL AND THE URL EMAIL IS DIFFERENT!
// ------------------------------------------------------------------

function sessionErrorRedirect($var){
	debug("Redirecting to index with error: $var");
	$_SESSION["error"] = $var;
	header("Location: index.php");
}

// ------------------------------------------------------------------

function sessionSurveyRedirect(){
	// Redirecting to the survey page
	debug("Redirecting to survey");
	header("Location: survey.php");
}

// ------------------------------------------------------------------

function checkEmail(){
	debug(" -- Checking email: --");
	if (isset($_SESSION['email'])){
		debug("Session email is set. Checking if the stored email has correct syntax");
		if (filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)){
			debug("Session email syntax is correct");
			// check database for verification //DBADD//
			checkID(); // checking id
		}else{
			debug("Session email syntax is not correct. Redirecting to index with error");
			sessionErrorRedirect("#998");
		}
	}elseif (isset($_GET['email'])){
		debug("Session email is not set but url email is set. Checking syntax:");
		if (filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)){
			debug("URL email syntax is correct. Checking with database for matches");
			// syntax is correct. Setting session email to url email once verified with database
			// check with database if email already exists //DBADD//
			$_SESSION['email'] = $_GET['email'];
			checkID(); // checking id
		}else{
			debug("URL email syntax is not correct. Redirecting to index with error");
			sessionErrorRedirect("emailsyntax");
		}
	}else{
		debug("Session email AND url email is not set. Redirecting to index with error");
		sessionErrorRedirect("email");
	}
}

// ------------------------------------------------------------------

function checkID(){
	debug(" -- Checking ID: --");
	if (isset($_SESSION['id'])){
		debug("Session ID is set. Checking with database for validation");
		// session id is set.
		checkPage();
	}else{
		debug("Session ID is not set. Checking if a session email is set so we can generate an ID");
		// session id is not set. If a session email is set, generate id and check with database. //DBADD//
		if (isset($_SESSION['email'])){
			$_SESSION['id'] = md5($_GET['email']);
			debug("A session email was found. Generated ID: " . md5($_GET['email']));
			debug("Checking with database if id's match");
			checkPage();
		}else{
			debug("Session email is not set. Redirecting to index with error code #999.");
			sessionErrorRedirect("#999");
		}
	}
}

// ------------------------------------------------------------------

function checkPage(){
	debug(" -- Checking Page: --");
	if (isset($_SESSION['page'])){
		debug("Session page is set. Checking if it's an integer");
		// session page is set already. checking if the page is an int:
		if (is_int($_SESSION['page'])){
			debug("The page is an integer");
			debug("Checking if the url contains submit");
			// session page is an int. check with database to see if they match. //DBADD//
			// indent next if statement after adding database check!!!!!
			// now checking to see if the user finished a question:
			if (isset($_GET['submit'])){
				debug("The url contains submit");
				debug("Checking which type of submit:");
				if ($_GET['submit'] === "Neste+spørsmål"){
					debug("The url contains 'Neste+spørsmål'");
					// adding 1 to the page //DBADD//
					debug("Adding 1 to the database page and session page");
					$_SESSION['page']++;
					debug("Redirecting to survey");
					sessionSurveyRedirect();
				}elseif ($_GET['submit'] == "Ta+undersøkelsen" || $_GET['submit'] == "Ta+unders%C3%B8kelsen"){
					debug("The url contains 'Ta+undersøkelsen' or 'Ta+unders%C3%B8kelsen'");
					// the user might have lost their session and started the survey with the same email as before.
					// send the user back to the survey since a pagenumber already exists:
					debug("Continue the survey. Redirecting");
					sessionSurveyRedirect();
				}else{
					debug("The submit type is unknown");
				}
			}else{
				// submit url variable was not set. the user might be tampering with the html OR got redirected by accident.
				// send the user back to the survey:
				sessionSurveyRedirect();
			}
		}else{
			// for some reason the page number is not an integer. get the page number from database and retry the entire function
			// //DBADD//
		}
	}else{
		// session page number was not set. Check with the database //DBADD//
		// change next statement after db is added
		
		// the user is new:
		$_SESSION["page"] = 1;
		sessionSurveyRedirect(); // redirecting to the survey
	}
}



function sessionCheckPage(){
	if (isset($_SESSION['page'])){
		// session page is set. Verifying with database once added. //DBADD//
		// Checking if the page number is int:
		if (is_int($_SESSION['page'])){
			// session page is int
			// since the page is set, checking if we are adding 1 to the page:
			if (isset($_GET['submit'])){
				if ($_GET['submit'] === "Neste+spørsmål"){
					// adding 1 to the page //DBADD//
					$_SESSION['page']++;
					sessionSurveyRedirect();
				}
			}
		}
	}else{
		// session page is not set
		if (isset($_GET['submit'])){
			if ($_GET['submit'] === "Ta+undersøkelsen"){
				// the user came from the index page and is about to start the survey
				// need to doublecheck with database for verification once added //DBADD//
				$_SESSION["page"] = 1;
				sessionSurveyRedirect();
			}elseif ($_GET['submit'] === "Ta+undersøkelsen"){
				// the user lost the session page while going to the next question.
				// get the page from database once added //DBADD//
				echo '|the user lost the session page while going to the next question|';
			}
		}
	}
}
?>