<?php 

function html2text($Document) {
	$Rules = array ('@<script[^>]*?>.*?</script>@si',
			'@<[\/\!]*?[^<>]*?>@si',
			'@([\r\n])[\s]+@',
			'@&(quot|#34);@i',
			'@&(amp|#38);@i',
			'@&(lt|#60);@i',
			'@&(gt|#62);@i',
			'@&(nbsp|#160);@i',
			'@&(iexcl|#161);@i',
			'@&(cent|#162);@i',
			'@&(pound|#163);@i',
			'@&(copy|#169);@i',
			'@&(reg|#174);@i',
			'@&#(d+);@e'
	);
	$Replace = array ('',
			'',
			'',
			'',
			'&',
			'<',
			'>',
			' ',
			chr(161),
			chr(162),
			chr(163),
			chr(169),
			chr(174),
			'chr()'
	);
	
	if (version_compare(phpversion(), '7.0.0', '>')) {
		return str_replace($Rules, $Replace, $Document);
	} else {
		return preg_replace($Rules, $Replace, $Document); 
	}
}

function goMail($link,$profil, $title,$date) {
	
	update_request(array("timeMail"=>$date),$link,'profils','user_id',$profil['user_id']);

	$comments_counter = getNewNotificationsNumber($link,$profil['user_id']);
	 
	$uPrivateMessages_counter = getNewPrivateMessagesNumber($link,$profil['user_id'])  +        getNewNotificationsNumber($link,$profil['user_id'],$private=true);
	 
	$uMessages_counter = getNewMessagesNumber($link,$profil['user_id']);
	 
	 
	$htmlText = '';
	$url = '';
	 
	$mail = true;
	if ($mail) {
		$url = 'http://up.aurele.eu/index.php';
	}
	 
	$htmlText .= '<ul class="icons">';
	$htmlText .= '<li>';
	if($mail) { $htmlText .= 'Vouz avez ';}
	$htmlText .= '<b><a href="'.$url.'?page=messages&amp;nonVu=1" class="icon fa-comments-o" ';
	if ($uMessages_counter != 0){$htmlText .= 'style="color:green"';}
	$htmlText .= '>';
	$htmlText .= $uMessages_counter;
	$htmlText .= '</a></b>';
	if($mail) {$htmlText .= ' messages non lus.';}
	$htmlText .= '</li>';
	 
	if($mail) {$htmlText .= '<br>';};
	 
	
	$htmlText .= '<li>';
	if($mail) { $htmlText .= 'Vouz avez ';}
	$htmlText .= '<b><a href="'.$url.'?page=messages&amp;nonVuC=1" class="icon fa-flag" ';
	if ($comments_counter != 0){$htmlText .= 'style="color:green"';}
	$htmlText .= '>';
	$htmlText .= $comments_counter;
	$htmlText .= '</a></b>';
	if($mail) {$htmlText .= ' nouvelles notifications.';}
	$htmlText .= '</li>';
	 
	if($mail) {$htmlText .= '<br>';};
	 
	$htmlText .= '<li>';
	if($mail) { $htmlText .= 'Vouz avez ';}
	$htmlText .= '<b><a href="'.$url.'?page=messages&amp;private=1" class="icon fa-envelope-o" ';
	if ($uPrivateMessages_counter != 0){$htmlText .= 'style="color:green"';}
	$htmlText .= '>';
	$htmlText .= $uPrivateMessages_counter;
	$htmlText .= '</a></b>';
	if($mail) {$htmlText .= ' messages privés ou commentaires de messages privés non lus.';}
	$htmlText .= '</li>';
	$htmlText .= '</ul>';
	 
	$rawText = html2text($htmlText);
	
    if (!empty($profil['email'])) {
        sendMail(
                $profil['email'],
                'contact@aurele.eu',
                $project,
                $title,
                $rawText,
                $htmlText
                );
	}
}

function sendMail($mail, $mailFrom, $fromName, $sujet, $message_txt, $message_html) {
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = $message_txt;
	$message_html = "<html><head></head><body>".$message_html."</body></html>";
	//==========
	 
	//=====Création de la boundary
	$boundary = "-----=".md5(rand());
	//==========
	 
	//=====Création du header de l'e-mail.
	$header = "From: \"".$fromName."\"<".$mailFrom.">".$passage_ligne;
	$header.= "Reply-to: \"".$fromName."\" <".$mailFrom.">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	//=====Ajout du message au format HTML
	$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
	//==========
	 
	//=====Envoi de l'e-mail.
	mail($mail,$sujet,$message,$header);
	//==========
}
?>