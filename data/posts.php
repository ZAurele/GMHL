<?php 
$message_envoye = false;

if($logged){
    // HABITATION
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['action'])){
            $error_message == '';
            
            $profil = true;
            
            switch ($_POST['action'] ) {
            	case 'updatePassword':
					include('posts/updatePassword.php');
					break;
					
                case 'updateHabitation':
	                $habitation = array(
	                        'user_id' => $user_id_session,
	                        'chauffage' => $_POST['chauffage'],
	                        'eau' => $_POST['eau'],
	                        'elec' => $_POST['elec'],
	                        'ascenseur' => $_POST['ascenseur']
	                );
	                insert_request($habitation,$link,'habitation');
	                break;
	                
                case  'sendMessage':
	                include ('upload.php');
	                
	                if ($uploaded_file['erreur'] == NULL) {
	                    $uploaded_file_folder = $uploaded_file['folder'];
	                } else {
	                	$uploaded_file_folder = '';
	                }
	    
					include('posts/categories.php');
					include('posts/message.php');
					
					break;

                case 'comment':
                	include('posts/comment.php');
                	break;
            }
        }
    } else {
        
        $habitations = select_request_s($link,'habitation',true,NULL,NULL);
        
        foreach ($habitations as $current_habitation) {
            if ($current_habitation['user_id'] == $user_id_session) {
                $habitation = $current_habitation;
            }
        }
    }
}
?>