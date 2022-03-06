<?php 
	$profil = false;

	$sql = 'SELECT * FROM users where username = "'.$_SESSION['login_user'].'"';

	$req = mysqli_query($link,$sql);
	if (!$req){
		echo mysqli_error($link);
		$count = 0;
	} else {
		$row = mysqli_fetch_array($req,MYSQLI_ASSOC);
		$count = mysqli_num_rows($req);
	}

	if (Password::verify($_POST['oldpassword'],$row['password'])) {

		if (strcmp($_POST['password1'],$_POST['password2']) == 0) {

			if (strlen($_POST['password1']) > 7) {
				$new_password = Password::hashaction($_POST['password1']);
				update_request(array('password'=>$new_password),$link,'users','id',$user_id_session);
				$profil = true;
			} else {
				$error_message = 'Le nouveau mot de passe est trop court (<8 caractères) !';
			}
		} else {
			$error_message = 'Les deux mots de passes ne sont pas identiques !';
		}
	} else {
		$error_message = 'Le mot de passe actuel est incorrect !';
	}

?>