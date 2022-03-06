<?php 
$commentsRead = false;

// comments
if (empty($message['comments'])) {
	$commentsCount = 0;
	
	$rCommentsArray = array();
} else {
	$messageComments = explode(',',$message['comments']);
	$commentsCount = count($messageComments);
	
	$rCommentsArray = explode(',',$rComments);
	
	foreach ($messageComments as $comment) {
		
		if (!in_array($comment,$rCommentsArray)) {
			$commentsCount--;
		}
	}
}

if ($commentsCount == 0) {
	$commentsRead = true;
}

?>