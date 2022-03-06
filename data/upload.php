<?php 
$folder_for_upload_image = NULL;

if (isset($_FILES['file_upload'])){	
	if ($_FILES['file_upload']['name'] != ''){
		$uploaded_file = upload('file_upload','img',$file_max_size_upload,$extensions_valides_images);
	}
}

function upload($name,$folder,$file_max_size_upload,$extensions_valides) {
	$error = 1;
	$time = time();
	
	$file_name_upload = $_FILES[$name]['name'];
	$file_type_upload = $_FILES[$name]['type'];
	$file_size_upload = $_FILES[$name]['size'];
	$file_tmp_name_upload = $_FILES[$name]['tmp_name'];
	$file_error_upload = $_FILES[$name]['error'];
	
	$extension_upload = strtolower(  substr(  strrchr($file_name_upload, '.')  ,1)  );
	
	$error_upload = '';
	if ($file_size_upload > $file_max_size_upload){
		$error_upload = '<font color="red">Fichier trop grand !</font>';
	}
	elseif( !in_array(strtoupper($extension_upload),$extensions_valides) ){
		$error_upload = '<font color="red">Le type du fichier n\'est pas bon:&nbsp;'.strtoupper($extension_upload).'</font>';
	}
	elseif ($file_error_upload > 0){
		switch ($file_error_upload) {
			case UPLOAD_ERR_NO_FILE :
				$error_upload = '<font color="red">Fichier manquant !</font>';
				break;
			case UPLOAD_ERR_INI_SIZE :
				$error_upload = '<font color="red">Fichier beaucoup trop gros !</font>';
				break;
			case UPLOAD_ERR_FORM_SIZE :
				$error_upload = '<font color="red">Fichier trop gros !</font>';
				break;
			case UPLOAD_ERR_PARTIAL :
				$error_upload = '<font color="red">Fichier transféré partiellement !</font>';
				break;
		}
	}
	
	$folder_for_upload_image = '';
	if ($error_upload == ''){
		$folder_for_upload_image = './tmp/'.$folder.'/'.$time.'.'.$extension_upload;
	
		$resultat = move_uploaded_file($file_tmp_name_upload,$folder_for_upload_image);
	
		if ($resultat){
			$error_upload = '<font color="green">Upload OK</font>';
			$error = 0;
		}else{
			$error_upload = '<font color="red">Erreur inconnue dans l\'upload !</font>';
		}
	}
	
	return array(
			'erreur' => $error,
			'message' => $error_upload,
			'folder' => $folder_for_upload_image
	);
}
?>