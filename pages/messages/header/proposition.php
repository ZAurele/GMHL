<?php 
$proposition = -1;
$propositions = explode(',',$message['proposition']);

if (!empty($propositions)) {
	if ($propositions != NULL) {
		if ((in_array($user_id_session,$propositions))) {
			$sql = "select proposition from proposition where user_id = '".$user_id_session ."' and message = '".$message['id']."'";
			$req = mysqli_query($link,$sql);

			if (!$req){
				report_sql(mysqli_error($link));
			} else {
				$proposition_found = mysqli_fetch_array($req,MYSQLI_ASSOC);
				$proposition = $proposition_found['proposition'];
			}
		}
	}
}

if (!$author) {
	if ($proposition != 1) {
		echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-1'),NULL).'">Oui</a>';
	} else {
		echo 'Oui';
	}

	echo ' / ';

	if ($proposition != 2) {
		echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-2'),NULL).'">Peut-être</a>';
	} else {
		echo 'Peut-être';
	}

	echo ' / ';

	if ($proposition != 0) {
		echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-0'),NULL).'">Non</a>';
	} else {
		echo 'Non';
	}
} else {
	$propositions = select_request_s($link,'proposition',true,'message',$message['id']);

	$votes = array(0,0,0);
	foreach ($propositions as $proposition) {
		$value = $proposition['proposition'];
		if ($value == 0) {
			$votes[0]++;
		} else if ($value == 1) {
			$votes[1]++;
		} else if ($value == 2) {
			$votes[2]++;
		}
	}

	echo 'Oui ('.$votes[1].') / Peut-être ('.$votes[2].') / Non ('.$votes[0].')';
}
?>