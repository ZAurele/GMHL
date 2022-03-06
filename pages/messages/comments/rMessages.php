<?php 
$messageRead = !in_array($message['id'],explode(',',$rMessages));

if (isset($_GET['nonVu']) || $_SESSION['nonVu']) {
	if ( ($messageRead || ($message['user_id'] == $user_id_session)) && $_SESSION['nonVu']){
		continue;
	} elseif ( (!$messageRead || $message['user_id'] == $user_id_session) && !$_SESSION['nonVu']){
		continue;
	}
}
?>