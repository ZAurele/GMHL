<?php 
// MESSAGE
$unique_id = uniqid();

$posts = array(
		"unique_id" => $unique_id,
		"user_id" => $_POST['user_id'],
		"title" => $_POST['title'],
		"creation_date" => date('d/m/Y'),
		"modification_time" => date('Y-m-d G:i:s'),
		"attached_files" => '',
		"type" => $_POST['type'],
		"priority" => $_POST['priority'],
		"message" => $_POST['message'],
		"categorie" => $id_categorie,
		"private" => false,
		"images" => $uploaded_file_folder
);

$modify = false;

if (isset($_GET['modify_post'])) {
	$modified_message = select_request_s($link,'posts',false,'id',$_GET['modify_post']);
	$modify = true;
	if ($modified_message['user_id'] == $user_id_session) {

		$posts["unique_id"] = $modified_message['unique_id'];
		$posts["creation_date"] = $modified_message['creation_date'];

		if (!isset($_POST['changeFile'])) {
			$posts["images"] = $modified_message['images'];
		}
	}
}

if (isset($_POST['to'])) {
	$posts['private'] = $_POST['to'];
}

if (isset($_POST['activateDate'])) {
	if (validateDate($_POST['dateEvenement'])) {
		$posts["dateEvenement"] = $_POST['dateEvenement'];
	} else {
		$posts["dateEvenement"] = date('Y-m-d');
	}
} else {
	if ($_POST['type'] == 'evenement') {
		$error_message = 'Le message est de type événement mais il n\'y a pas de date !';
	}
}

if ($error_message == '') {
	if (!$modify) {
		insert_request($posts,$link,'posts');
	} else {
		if (isset($_POST['changeFile'])) {
			if (file_exists($modified_message['images'])) {
				unlink($modified_message['images']);
			}
		}

		update_request($posts,$link,'posts','id',$modified_message['id']);
	}

	// UPDATE des messages non vus
	$postedMessage = select_request_s($link,'posts',false,'unique_id',$posts["unique_id"]);
	if (!$posts['private']) {
		# inform that the message is updated
		set_values_specified_for_all_users($link,'rMessages','users',format($postedMessage['id']),"id",$user_id_session);
	} else {
		set_values_specified($link,'rMessages','users',format($postedMessage['id']),"id",$postedMessage['private']);
	}

	// Update categories
	$categorie_message = $posts['unique_id'];
	if ($categorie['messages'] != '') {
		$categorie_message = $categorie['messages'] . "," . $posts['unique_id'];
	}
	$datas = array(
			"messages" => $categorie_message
	);

	update_request($datas,$link,'categories','id',$id_categorie);

	$message_envoye = true;
    
    // MAILS
    if (!$modify) {
		if (!$posts['private']) {
			mailForAllUsers($link,$PROFILS,$DATE,$user_id_session,'new_message');
		} else {
            $profil_private = select_request_s($link,'profils',false,'user_id',$posts['private']);
            goMail($link,$profil_private,'Nouveau message privé',$DATE);
		}
    } else {
		if (!$posts['private']) {
			mailForAllUsers($link,$PROFILS,$DATE,$user_id_session,'update_message');
		} else {
            $profil_private = select_request_s($link,'profils',false,'user_id',$posts['private']);
            goMail($link,$profil_private,'Nouveau message privé',$DATE);
		}
    }
}
?>