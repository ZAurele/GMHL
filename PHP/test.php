<?php 
include 'src/functions.php';
include "utils/constants.php";

$link = new mysqli($host,$user,$passwd,$db);
if (mysqli_connect_error()) {
	die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

if (isset($_POST['username'])) {
	DEBUG('YOOOOOOOOOOO'.$_POST['username']);
} else {
	debug('no');
}

foreach ($_POST as $param_name => $param_val) {
	debug("Param: $param_name; Value: $param_val<br />\n");
}

print_r(parse_url($url, PHP_URL_FRAGMENT));

#unset_values_specified($link,'rComments','users',format($_GET['rComment']),"id",$user_id_session);
?>