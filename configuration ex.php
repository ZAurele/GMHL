<?php 
// Site
$version = "1.0.0";
$project = "GMHL";

// Colors
$primary = "#3498db";
$secondary = "#779035";

// Crypt
$cryp_key ="somecryptkey";

// Files
$file_max_size_upload = 5048576;
$error_message = '';
$error_upload = '';

// Database
$host = "";
$user = "";
$passwd = "";
$db = "";


if (is_localhost()) {
	$host="localhost";
	$user="";
	$passwd="";
	$db = "gmhl";
}
?>