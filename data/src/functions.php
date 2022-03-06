<?php 

function getNewPrivateMessagesNumber($link,$user_id_session) {
	$user = select_request_s($link,'users',false,'id',$user_id_session);

	$rMessages = $user['rMessages'];
	
	$rMessagesArray = explode(',',$rMessages);
	
	$uMessages_counter = 0;
	$receivedMessages = select_request_s($link,'posts',true,'private',$user_id_session);
	
	foreach ($receivedMessages as $receivedMessage) {
		if(in_array($receivedMessage['id'],$rMessagesArray)) {
			$uMessages_counter++;
		}
	}
	
	return $uMessages_counter;
}

function getNewMessagesNumber($link,$user_id_session){
	$user = select_request_s($link,'users',false,'id',$user_id_session);
	$rMessages = $user['rMessages'];
	
	$rMessagesArray = explode(',',$rMessages);
	
	$uPrivateMessages_counter = 0;
	
	foreach ($rMessagesArray as $rMessage) {
		$message = select_request_s($link,'posts',false,'id',$rMessage);
	
		if ($message != null) {
			if ( !$message['private'] && !($message['user_id'] == $user_id_session)) {
				$uPrivateMessages_counter++;
			}
		}
	}
	return $uPrivateMessages_counter;
}

function getNewNotificationsNumber($link,$user_id_session,$private=false) {
	$user = select_request_s($link,'users',false,'id',$user_id_session);
	$rComments = $user['rComments'];
	$rCommentsArray = explode(',',$rComments);
	
	$comments_counter = 0;
	$received_messages = 0;
	
	if (!empty($rComments)) {		
		$unreadComments = array();
	
		foreach ($rCommentsArray as $rComment) {
			$comment = select_request_s($link,'comments',false,'unique_id',$rComment);
			$commentMessage = select_request_s($link,'posts',false,'id',$comment['message']);
	
			if ($commentMessage != null) {
					
				if (!($comment['sender'] == $user_id_session) && $commentMessage['private']) {
					$received_messages++;
				}
					
				if (!($comment['sender'] == $user_id_session) && !$commentMessage['private'] && !(in_array($comment['unique_id'],$unreadComments))) {
					$comments_counter++;
					$unreadComments[] = $comment['unique_id'];
				}
			}
		}
	}
	
	if (!$private) {
		return $comments_counter;
	}else {
		return $received_messages;
	}
}
?>