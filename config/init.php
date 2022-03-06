<?php 
# CONFIGURATION
$set = 3;

if (($set == 0) || ($set == 1)) {
	$sql = "SELECT * FROM posts order by id DESC";
	$messagesA = select_request($link,$sql);

	$sql = "SELECT * FROM users order by id DESC";
	$usersA = select_request($link,$sql);

	foreach ($usersA as $userA) {
		if ($set) {
			foreach ($messagesA as $messageA) {
				$rMessages = $userA['rMessages'];
					
				if (($messageA['private'] == 0) && !($messageA['user_id'] == $userA['id'])) { # TO DELETE
					set_values_specified($link,'rMessages','users',format($messageA['id']),'id',$userA['id']);
				}
			}
		} else {
			$postsss = explode(',',$userA['rMessages']);
			foreach ($postsss as $ppp)
				unset_values_specified($link,'rMessages','users',format($ppp),'id',$userA['id']);
		}
	}
}

$setComments = 3;

if (($setComments == 0) || ($setComments == 1)) {
	$sql = "SELECT * FROM posts order by id DESC";
	$messagesA = select_request($link,$sql);

	$sql = "SELECT * FROM users order by id DESC";
	$usersA = select_request($link,$sql);

	foreach ($usersA as $userA) {
		if ($setComments) {
			foreach ($messagesA as $messageA) {
				if ($messageA['private']) {
					continue;
				}
				$rCommentsMessages = $messageA['comments'];
				$rCommentsMessagesArray = explode(',',$rCommentsMessages);
				
				foreach ($rCommentsMessagesArray as $rCommentsMessage) {
					
					$commentData = select_request_s($link,'comments',false,'unique_id',$rCommentsMessage);
					
					if ($commentData['sender'] != $user_id_session) {
						set_values_specified($link,'rComments','users',format($rCommentsMessage),'id',$userA['id']);
					}
				}
			}
		} else {
			$rComments = $userA['rComments'];
			$rCommentsArray = explode(',',$rComments);
			
			foreach ($rCommentsArray as $rComment)
				unset_values_specified($link,'rComments','users',format($rComment),'id',$userA['id']);
		}
	}
}
?>