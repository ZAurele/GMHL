<?php 

$message_with_comment = select_request_s($link,'posts',false,'id',$_POST['attached_message']);
$existing_comments = explode(',',$message_with_comment['comments']);

if (!(in_array($_POST['comment_id'], $existing_comments))) {

	$comment = array(
			"unique_id" => $_POST['comment_id'],
			"message" => $_POST['attached_message'],
			"sender" => $user_id_session,
			"comment" => $_POST['comment'],
			"creation_time" => date("Y-m-d H:i:s"),
			"modification_time" => date("Y-m-d H:i:s")
	);

	insert_request($comment,$link,'comments');
	
	$new_comment = $message_with_comment['comments'].','.$_POST['comment_id'];
	if ( $message_with_comment['comments'] == '') {
		$new_comment = $_POST['comment_id'];
	}

	$comments = array("comments" => $new_comment);
	update_request($comments,$link,'posts','id',$_POST['attached_message']);
	
	# inform that the comment is updated

	set_values_specified_for_all_users($link,'rComments','users',format($_POST['comment_id']),"id",$user_id_session);
    
    mailForAllUsers($link,$profils_infos,$DATE,$user_id_session,'new_comment');
}
?>