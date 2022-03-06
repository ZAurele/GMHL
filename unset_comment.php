<?php
include 'src/functions.php';
include 'src/database.php';
include 'utils/constants.php';

$link = new mysqli($host,$user,$passwd,$db);

if (mysqli_connect_error()) {
	die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

if (isset($_POST['user_id']) && isset($_POST['id'])) {
	
	$comments_from_the_message = select_request_s($link,'comments',true,'message',$_POST['id']);

	foreach ($comments_from_the_message as $comment) {
		debug('unset comment: '.$comment['unique_id']);
		debug('User: '.$_POST['user_id']);
		
		unset_values_specified($link,'rComments','users',format($comment['unique_id']),"id",$_POST['user_id']);
	}
	
} else {
	debug('Error with unset_comments');
}
?>