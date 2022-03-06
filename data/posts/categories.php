<?php 
// CATEGORIE
if(isset($_POST['nouvelle_categorie'])) {
	if($_POST['nouvelle_categorie'] != '') {
		 
		// insert new categorie
		$datas = array(
				"categorie" =>  $_POST['nouvelle_categorie'],
				"messages" => $posts['unique_id']
		);
		insert_request($datas,$link,'categories');

		// select categorie
		$categorie = select_request_s($link,'categories',false,'categorie',$_POST['nouvelle_categorie']);
		$id_categorie = $categorie['id'];

	} else {
		// select categorie
		$categorie = select_request_s($link,'categories',false,'id',$_POST['categorie']);
		$id_categorie = $_POST['categorie'];
	}
} else {
	$id_categorie = 19;
	$categorie = select_request_s($link,'categories',false,'id',$id_categorie);
}

if (!isset($_POST['type'])) {
	$_POST['type'] = 'nouvelles';
}
?>