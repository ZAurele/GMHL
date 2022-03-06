<?php 
if (isset($_GET['modify_post'])) {
	$message = select_request_s($link,'posts',false,'id',$_GET['modify_post']);

	if ($message['user_id'] == $user_id_session) {
		$posts = $message;
	}
}

if (isset($_GET['delete_post'])) {
	$message = select_request_s($link,'posts',false,'id',$_GET['delete_post']);
		
	$postedMessage = select_request_s($link,'posts',false,'unique_id',$posts["unique_id"]);
	
	if ($message['user_id'] == $user_id_session) {
		
		delete_request($link,'posts','id',$_GET['delete_post']);
	
		unset_values_specified($link,'rMessages','users',format($_GET['delete_post']),"id",$user_id_session);
	}
}
?>