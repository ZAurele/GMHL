<?php 
$etats = array(
		'0'=>array('green','ON','2'),
		'2' =>array('orange','Moyen','2'),
		'4' =>array('red','OFF','2')
);

$habitation = array(
		'chauffage' => '0',
		'eau' => '0',
		'elec' => '0',
		'ascenseur' => '0'
);

$types = array(
		'nouvelles' => array('text'=>'Nouvelles','icon'=>'newspaper-o'),
		'travaux' => array('text'=>'Dysfonctionnements et Travaux','icon'=>'warning'),
		'evenement' => array('text'=>'Evénement','icon'=>'calendar'),
		'proposition' => array('text'=>'Proposition','icon'=>'question')
);

$frequence_notifications = array(
		0 => "- Notifications -",
		1 => "Ne jamais me notifier par mail",
		2 => "Me notifier une fois par mois",
		3 => "Me notifier une fois par semaine",
		4 => "Me notifier une fois par jour",
		5 => "Me notifier à chaque message"
);

$posts = array(
		"unique_id" => uniqid(),
		"user_id" => '',
		"title" => '',
		"creation_date" => date('d/m/Y'),
		"attached_files" => '',
		"type" => 'nouvelles',
		"message" => '',
		"categorie" => '',
		"priority" => 'normal'
);

$comment = array(
		"unique_id" => '',
		"message" => '',
		"sender" => '',
		"comment" => '',
		"creation_time" => '',
		"modification_time" => ''
);

$permanent_url = array(
		'offset',
		'page',
		'private'
);

$uploaded_file = array(
		'erreur' => '',
		'message' => '',
		'folder' => ''
);

$extensions_valides_images = array( 'JPG' , 'JPEG' , 'GIF' , 'PNG', 'PDF');
?>