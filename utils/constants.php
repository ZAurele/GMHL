<?php 
// Site
$version = "1.0.0";
$project = "GMHL";

$primary = "#3498db";
$secondary = "#779035";

$cryp_key ="HelloMyNameIsAureleAndIAmAnEngineer";

$file_max_size_upload = 5048576;
$error_message = '';

$error_upload = '';

$firstlogin = false;

// Database

function is_localhost() {
	return true;
	$whitelist = array( '127.0.0.1', '::1' );
	if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
		return true;
}

if (is_localhost()) {
	$host="localhost";
	$user="root";
	$passwd="Adama14s7";
	$db = "gmhl";
}
else {
	$host = "artetsolhotest.mysql.db";
	$user = "artetsolhotest";
	$passwd = "AureleIsTheBest2020";
	$db = "artetsolhotest";
}

// Dates
$daysInTheMonth = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
$firstDayInTheMonth = date("w",mktime(0,0,0,date("m"),1,date("Y")));

?>