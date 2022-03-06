<?php 


function etat_bi($array,$key,$etats,$appartement,$link) {
	$counter_0 = 0;
	$counter_4 = 0;
	$messages = '';

	foreach ($array as $element) {
			
		$profil = select_request_s($link,'profils',false,'user_id',$element['user_id'],'DESC');

		$messages .= "Ap. ".$appartement." - ".$profil['prenom']." ".$profil['nom'].": <b style='color:".$etats[$element[$key]][0].";'>".$etats[$element[$key]][1]."</b></br>";

		if ($element[$key] == 0) {
			$counter_0 += 1;
		} else {
			$counter_4 += 1;
		}
		if ($counter_0 == $etats['0'][2]) {
			break;
		}
	}

	$complement = '';
	if ($counter_4 > $etats['0'][2]) {
		$color = $etats['4'][0];
		$state_string = $etats['4'][1];
		$etat = 4;
	} else {
		$color = $etats['0'][0];
		$state_string = $etats['0'][1];

		if ($counter_4 >= $etats['0'][2]/2) {
			$complement = '<b style="color:'.$etats['4'][0].';">?</b>';
		}
		$etat = 0;
	}

	$state = array(
			'state' => $state_string,
			'couleur' => $color,
			'messages' => $messages,
			'counter' => array('4' => $counter_4),
			'complement' => $complement,
			'etat' => $etat
	);
	return $state;
}
?>