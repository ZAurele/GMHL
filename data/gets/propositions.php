<?php 
if (isset($_GET['proposition'])) {
	$user_proposition = explode('-',$_GET['proposition'])[0];
	$message_proposition = explode('-',$_GET['proposition'])[1];
	$valeur_proposition = explode('-',$_GET['proposition'])[2];

	echo 'a'.$valeur_proposition;

	$temp = select_request_s($link,'posts',false,'id',$message_proposition);

	$propositions = explode(',',$temp['proposition']);

	if ($temp['proposition'] != '' && !in_array($user_proposition,$propositions)) {
		$users_proposition = $temp['proposition'].','.$user_proposition;
	} else{
		$users_proposition = $user_proposition;
	}

	$propositions = explode(',',$temp['proposition']);

	// UPDATE
	update_request(array('proposition'=>format($users_proposition)),$link,'posts','id',$message_proposition);

	$sql = "select id from proposition where user_id = '$user_proposition' and message = '".$message_proposition."'";
	$req = mysqli_query($link,$sql);

	if (!$req){
		report_sql(mysqli_error($link));
	} else {
		$proposition_update = array('proposition' => $valeur_proposition);
		$propositions_found = mysqli_fetch_array($req,MYSQLI_ASSOC);

		if (sizeof($propositions_found) > 0) {
			update_request($proposition_update,$link,'proposition','id',$propositions_found['id']);
		} else {
			$proposition_update = array('proposition' => $valeur_proposition,'user_id' => $user_id_session, 'message' => $message_proposition);
			insert_request($proposition_update,$link,'proposition');
		}
	}

}
?>