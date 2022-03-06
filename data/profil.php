<?php 
if(isset($_SESSION['login_user']) && empty($_POST['logout'])){
	// USERS
	$user_check = $_SESSION['login_user'];
	
	$sql = "select * from users where username = '$user_check'";
	$ses_sql = mysqli_query($link,$sql);
	$USER = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
}

if($logged){
	$rMessages = $USER['rMessages'];
	
	$rComments = $USER['rComments'];
	
	$comments_counter = getNewNotificationsNumber($link,$user_id_session);
	
	$uPrivateMessages_counter = getNewPrivateMessagesNumber($link,$user_id_session);
	
	$uMessages_counter = getNewMessagesNumber($link,$user_id_session) + getNewNotificationsNumber($link,$user_id_session,$private=true);
}
?>