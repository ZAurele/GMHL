<?php 
if (isset($_GET['delete_comment'])) {
	$comment = select_request_s($link,'comments',false,'unique_id',$_GET['delete_comment']);

	$message = select_request_s($link,'posts',false,'id',$comment['message']);

	$new_comments = str_replace(','.$_GET['delete_comment'],'',$message['comments']);
	$new_comments = str_replace($_GET['delete_comment'],'',$new_comments);

	update_request(array('comments'=>$new_comments ),$link,'posts','id',$comment['message']);

	delete_request($link,'comments','unique_id',$_GET['delete_comment']);
	
	unset_values_specified($link,'rComments','users',format($_GET['delete_comment']),"id",$user_id_session);
}
?>