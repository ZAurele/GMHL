<?php 
set_unset_values($link,'upVote','up_vote','posts','id');
set_unset_values($link,'favori','favori','posts','id');
set_unset_values($link,'vues','rMessages','users','id');

include 'gets/travaux.php';
include 'gets/comment.php';
include 'gets/propositions.php';
include 'gets/posts.php';

if (isset($_GET['view'])) {
    $users_view = explode('-',$_GET['view'])[0];
    $message_view = explode('-',$_GET['view'])[1];
    
    update_request(array('vue'=>format($users_view)),$link,'posts','id',$message_view);
}

if (isset($_GET['passwordChange'])) {
    $profil = false;
}
?>