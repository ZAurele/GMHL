<?php 
// Site
$version = "1.0.0";
$project = "GMHL";

// Colors
$primary = "#3498db";
$secondary = "#779035";

// Crypt
$cryp_key ="HelloMyNameIsAureleAndIAmAnEngineer";

// Files
$file_max_size_upload = 5048576;
$error_message = '';
$error_upload = '';

// Database
$host = "artetsolhotest.mysql.db";
$user = "artetsolhotest";
$passwd = "";
$db = "artetsolhotest";

if (is_localhost()) {
	$host="localhost";
	$user="root";
	$passwd="Adama14s7";
	$db = "gmhl";
}
?>