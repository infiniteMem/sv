<?php
// Function for checking url
function checkURL($array){
	// Checking each element in the array
	foreach ($array as $key => $value){
		if (isset($_GET["$key"])){
			// The current element was found in the url
			$array[$key]=1;
		}else{
			// The current element was not found in the url
			$array[$key]=2;
		}
	}
	// Returning changed array to the variable
	$needFix = false;
	if ($array["page"] == 2){
		// Page number is not in the url.
		// Since the page is not set and we have no DB connected, redirect to ?page=1 afterwards
		$pageString = "1";
		$needFix = true;
	}else{
		$pageString = "?page=".$_GET['page'];
	}
	if ($array["id"] == 2){
		// The missing element is 'id'
		// Generate ID
		$id = mt_rand(12345,99516121);
		$id = md5($id);
		$idString = $id;
		$needFix = true;
	}else{
		$idString = $_GET['id'];
	}
	if ($needFix === true){
		header("Location: ?page=$pageString&id=$idString");
	}
	return($array);
}
?>