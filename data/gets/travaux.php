<?php 
if (isset($_GET['travaux'])) {
	$state_travaux = explode('-',$_GET['travaux'])[0];
	$message_travaux = explode('-',$_GET['travaux'])[1];

	$temp = select_request_s($link,'posts',false,'id',$message_travaux);

	if ($user_id_session == $temp['user_id']) {
		if (0 <= intval($temp['travaux']) && intval($temp['travaux']) < 4) {

			$state = intval($temp['travaux']);
			if (intval($temp['travaux']) == 3 && $state_travaux == 0) {
				$state--;
			} else if (intval($temp['travaux']) == 0 && $state_travaux == 1) {
				$state++;
			} else {
				if (0 < intval($temp['travaux']) && intval($temp['travaux']) < 3) {
					switch ($state_travaux) {
						case '0':
							$state--;
							break;
						case '1':
							$state++;
							break;
					}
				}
			}
			update_request(array('travaux'=>$state),$link,'posts','id',$message_travaux);
		}
	}
}
?>