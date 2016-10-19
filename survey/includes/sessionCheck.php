<?php
// This file contains functions for checking session variables
function sessionCheckIndex($type){
	// Checking what $type of action to perform
	switch ($type) {
		case "errormsg":
			// Checking for errors to output
			if (isset($_SESSION['error'])){
				if ($_SESSION['error']==="email"){
					echo '<span class="errorMessage">Vennligst skriv inn en epost adresse.</span><br>';
					sessionDel("error"); // Removing error session
				}elseif ($_SESSION['error']==="emailsyntax"){
					echo '<span class="errorMessage">Epost adressen ble ikke skrevet riktig.</span><br>';
					sessionDel("error"); // Removing error session
				}elseif ($_SESSION['error']==="#999"){
					echo '<span class="errorMessage">Noe gikk veldig galt. Vennligst ta kontakt med IT support. Error kode: #999</span><br>';
					sessionDel("error"); // Removing error session
				}
				elseif ($_SESSION['error']==="#998"){
					echo '<span class="errorMessage">Noe gikk veldig galt. Vennligst ta kontakt med IT support. Error kode: #998.</span><br>';
					sessionDel("error"); // Removing error session
				}
			}else{
				// no error session is set. Echoing a newlines.
				echo '<br>';
			}
			break;
		case "":
			break;
	}
}

function sessionDel($sessionName){
	// Removes a session variable
	if (isset($_SESSION[$sessionName])){
		unset($_SESSION[$sessionName]);
	}
}
?>