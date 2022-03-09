<div id="commentaires_<?=$message['id']?>" style="display:none;">
<?php 
if ($message['comments'] != '') {
    $id_comments = explode(',',$message['comments']);
    $id_comments = array_reverse($id_comments);
    
    foreach ($id_comments as $id_comment) {
        $comment = select_request_s($link,'comments',false,'unique_id',$id_comment);
        echo '<blockquote>';
        
        if ($comment['sender'] == $user_id_session){
            echo '<a href ="'.get_url(array('delete_comment'=>$comment['unique_id']),NULL).'" style="float:right;" class="icon fa-times"></a>';
        }
        echo formatO($comment['comment']);
        
        $user_comment_link = get_user_pseudo($comment['sender']);
        
        echo '<span style="font-size:14px;color:#000000"><br/>'.$comment['creation_time'].' <a href="?page=message&amp;to='.$comment['sender'].'" class="icon fa-user"> '.$user_comment_link.'</a></span>';
        echo '</blockquote>';
    }
}
?>
</div>


<form method="post" action="#message<?=$message['id']?>" id="comment<?=$message['id']?>" style="display:none;">
    <div class="12u$(small)">
        <textarea name="comment" id="comment" placeholder="Entrer votre commentaire" rows="3"></textarea>
        <ul class="actions vertical small">
            <li><input type="submit" value="Envoyer" class="button special small fit" /></li>
            <input type="hidden" name="attached_message" value="<?=$message['id']?>">
            <input type="hidden" name="comment_id" value="<?=uniqid()?>">
            <input type="hidden" name="action" value="comment">
        </ul>
    </div>
</form>