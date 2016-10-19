<?php
session_start();
checkk("id");
checkk("email");
checkk("error");
checkk("page");
function checkk($name){
	if (isset($_SESSION[$name])){
		echo '$_session["'.$name.'"] = '. $_SESSION[$name] .'<br>';
	}else{
		echo '$_session["'.$name.'"] = NOT SET<br>';
	}
}

?>