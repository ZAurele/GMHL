<div align="right">
                <?php 
                $user_icon = "user";
                $country = $user['country']; #TODO: update
                if (!$author):
                ?>
                <a href="?page=message&amp;to=<?=$message['user_id']?>" style="font-size:14px;" class="icon fa-<?=$user_icon?>"> <?=$user_link?> </a>le 
                <?php 
                else:
                ?>
                <span style="font-size:14px;" class="icon fa-<?=$user_icon?>"> <?=$user_link?> </span>le 
                <?php 
                endif;
                ?>
                <b style="font-size:14px;"><?=$message['modification_time']?></b>
                <?php                 
                if (strpos($message['up_vote'],',')) {
                    $upVotes = explode(',',$message['up_vote']);
                } else {
                    $upVotes = [$message['up_vote']];
                }
                
                $number_of_comments = 0;
                if ($message['comments'] != '') {
                    $id_comments = explode(',',$message['comments']);
                    $number_of_comments = sizeof($id_comments);
                }
                ?>
                <?php if ($message['user_id'] == $user_id_session):?>
                 - <a class="icon fa-trash-o" href="<?=get_url(array('page'=>'message','modify_post'=>$message['id']),NULL)?>" style="color:#01b0f0"> Modifier</a>
                 - <a class="icon fa-trash-o" href="<?=get_url(array('delete_post'=>$message['id']),NULL)?>"> Supprimer</a>
                 <?php endif;?>
                 - <a class="icon fa-commenting-o" href="#message<?=$message['id']?>" onclick="show('comment<?=$message['id']?>')" style="color:#01b0f0"> Ajouter un commentaire</a>
                <?php if ($number_of_comments != 0):?>
                 - <a class="icon fa-comments-o" href="#message<?=$message['id'];?>" onclick="showAndUnview('commentaires_<?=$message['id']?>','<?=$message['id']?>','<?=$user_id_session?>');"> Afficher les commentaires (<?=$number_of_comments?>)</a>
                <?php endif;?>
                <?php if ((!$author) && (!in_array($user_id_session,$upVotes))):?>
                 - <a href="<?=get_url(array('upVote'=>$user_id_session.'-'.$message['id']),NULL)?>" class="icon fa-thumbs-o-up" style="color:#01b0f0"> Remercier</a> 
                <?php elseif ($author):
                    $numberOfVotes = 0;
                    if (count($upVotes) == 1) {
                        if ($message['up_vote'] != '') {
                            $numberOfVotes = 1;
                        }
                    } else {
                        $numberOfVotes = count($upVotes);
                    }
                ?>
                 - Merci (<?=$numberOfVotes?>)
                <?php endif;?>
                
                <?php if (!$author):?>
                - <a href="<?=get_url(array('favori'=>$user_id_session.'-'.$message['id']),NULL)?>" style="color:#01b0f0" class="icon fa-star<?php if(!in_array($user_id_session,explode(',',$message['favori']))){echo'-o';}?>"> </a> 
                - <a href="<?=get_url(array('vues'=>$message['id'].'-'.$user_id_session,'nonVu'=>1),NULL)?>" <?php if(!$messageRead){echo 'style="color:#01b0f0"';}?> class="icon fa-<?php if($messageRead){echo'check-';}?>square-o"> </a> 
                <?php endif;?>
            </div>