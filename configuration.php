<?php 
// Site
$VERSION_SITE = "1.0.0";
$project = "CERP";

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
$host = "projeawcerp.mysql.db";
$user = "projeawcerp";
$passwd = "LECERPCESTtropcool192387";
$db = "projeawcerp";

if (is_localhost()) {
	$host="localhost";
	$user="root";
	$passwd="root";
	$db = "cerp";
}
?>