<?php if($logged):
    $user_selected = select_request_s($link,'users',false,'id',$user_id_session);
    $current_time = date('Y-m-d G:i:s');
    
    if (strcmp(explode(' ',$user_selected['modificationTime'])[0],explode(' ',$current_time)[0]) != 0) {
        update_request(array('modificationTime'=>$current_time),$link,'users','id',$user_id_session);
    }
    
    if (isset($_GET['private'])) {
    	if ($_GET['private']) {
    		echo '<section><div style="float:right;">';
		    if (isset($_GET['archive'])) {
		       if ($_GET['archive']) {
		        	echo '<a href="'.get_url(array('archive'=>'0'),NULL).'" class="icon fa-archive"> Non vues</a>';
		       } else {
		       	    echo '<a href="'.get_url(array('archive'=>'1'),NULL).'" class="icon fa-archive"> Vues (Achives)</a>';
		       }
		    } else {
		    	echo '<a href="'.get_url(array('archive'=>'1'),NULL).'" class="icon fa-archive"> Vues (Achives)</a>';
		    }
		    echo '</div></section>';
    	}
    }
    ?>

<section>
	<div class="mini-posts">
<?php
if( isset($_GET['sdate']) ){
	$messages = select_request_s($link,'posts',true,'dateEvenement',$_GET['sdate']);
} 
elseif( isset($_GET['categorie']) ){
	$messages = select_request_s($link,'posts',true,'categorie',$_GET['categorie']);
} 
elseif( isset($_GET['type']) ){
	$messages = select_request_s($link,'posts',true,'type',$_GET['type']);
}
elseif(isset($_POST['search'])){

	$sql = "SELECT * FROM posts where title like '%".$_POST['search']."%' or message like '%".$_POST['search']."%'";

	$messages = select_request($link,$sql);
}
else{
	$sql = "SELECT * FROM posts order by id DESC";
	$messages = select_request($link,$sql);
}

$limit_messages = 10;
$counter = 1;
//$number_of_messages = sizeof($messages);

$offset = 0;
if (isset($_GET['offset'])) {
	$offset = $_GET['offset'];
}

$number_of_messages = 0;

foreach ($messages as $message):
	$author = false;

	if ($message['user_id'] == $user_id_session){
		$author = true;
	}

	if (isset($_GET['private'])) {
		if ($_GET['private']) {
			if (!$message['private']){
				continue;
			} else {
				if ($message['private'] != $user_id_session) {
					continue;
				}
                
                if (isset($_GET['archive'])){
                    if ($message['vue'] && !$_GET['archive']) {
                        continue;
                    } elseif (!$message['vue'] && $_GET['archive']) {
                        continue;
                    }
                } else {
                    if ($message['vue']) {
                        continue;
                    }
                }
			}
		}
	} else {
		if ($message['private']){
			continue;
		}
	}
	
	if (isset($_GET['favoris'])) {
		$favoris = explode(',',$message['favori']);
		if (!in_array($user_id_session,$favoris)) {
			continue;
		}
	}
	
	$number_of_messages++;
	if ($counter <= $offset*$limit_messages) {
		$counter++;
		continue;
	}
	
	if ($counter > ($limit_messages*$offset + $limit_messages)) {
		continue;
	}

	$user = select_request_s($link,'profils',false,'user_id',$message['user_id']);
	$user_user = select_request_s($link,'users',false,'id',$message['user_id']);

	if ($user['profil_view'] == 'nom-prenom') {
		$user_link = $user['prenom'] . ' ' . $user['nom'];
	}
	else {
		$user_link = 'Appartement n°'.$user_user['appartement'];
	}
	
	$prio_style = $message['priority'];
	
	$categorie = select_request_s($link,'categories',false,'id',$message['categorie']);
	
	$categorie_icon = "bars";
	if (isset($categorie['icon'])) {
		if ($categorie['icon'] != "") {
			$categorie_icon = $categorie['icon'];
		}
	}
	?>
    <article>
    	<!--  HEADER -->
		<header class="<?=$prio_style?>" id="message<?=$message['id']?>">
            <?php 
            if ($message['private']):
            	if(!$message['vue']):?>
            <a href="<?=get_url(array('view'=>'1-'.$message['id']),NULL)?>" class="icon fa-eye" style="font-size:20px;color:blue;"></a> - 
			<?php else:?>
            <a href="<?=get_url(array('view'=>'0-'.$message['id']),NULL)?>" class="icon fa-eye-slash" style="font-size:20px;color:blue;"></a> - 
            <?php 
            	endif;
            endif;
            ?>
            <div align="right"style="float:right" class="boxA">
                <?php 
                switch($message['type']) {
                    case 'evenement':
                        break;
                    case 'travaux':
                    	// previous
                    	if ($message['travaux'] != 0 && $author) {
                        	echo '<a href="'.get_url(array('travaux'=>'0-'.$message['id']),NULL).'">';
			        		switch ($message['travaux']) {
			        			case '1':
			        				echo 'Vue';
			        				break;
			        			case '2':
			        				echo 'Signalé';
			        				break;
			        			case '3':
			        				echo 'En cours';
			        				break;
			        		}
		        			echo '</a> &#10142; ';
		        		}
		        		
		        		// current
		        		switch ($message['travaux']) {
		        			case '0':
		        				echo '<b style="color:red">Vue</b>';
		        				break;
		        			case '1':
		        				echo '<b style="color:orange">Signalé</b>';
		        				break;
	        				case '2':
	        					echo '<b style="color:blue">En cours</b>';
	        					break;
        					case '3':
        						echo '<b style="color:green">Fini</b>';
        						break;
		        		}
		        		// next
                        if ($message['travaux'] != 3) {
                            echo ' &#10142; ';
                        }
		        		if ($message['travaux'] != 3 && $author) {
		        			echo '<a href="'.get_url(array('travaux'=>'1-'.$message['id']),NULL).'">';
                        }
			        		switch ($message['travaux']) {
			        			case '0':
			        				echo 'Signalé ';
			        				break;
			        			case '1':
			        				echo 'En cours ';
			        				break;
			        			case '2':
			        				echo 'Fini ';
			        				break;
			        		}
                        if ($message['travaux'] != 3 && $author) {
		        			echo '</a>';
		        		}
                        break;
                    case 'proposition':
                    	$proposition = -1;
                    	$propositions = explode(',',$message['proposition']);
                    	
                    	if (!empty($propositions)) {
	                    	if ($propositions != NULL) {	
	                    		if ((in_array($user_id_session,$propositions))) {
	                    			$sql = "select proposition from proposition where user_id = '".$user_id_session ."' and message = '".$message['id']."'";
	                    			$req = mysqli_query($link,$sql);
	                    			
	                    			if (!$req){
	                    				report_sql(mysqli_error($link));
	                    			} else {
	                    				$proposition_found = mysqli_fetch_array($req,MYSQLI_ASSOC);
	                    				$proposition = $proposition_found['proposition'];
	                    			}
	                    		}
	                    	}
                		}
                		
                    	if (!$author) {
                    		if ($proposition != 1) {
                    			echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-1'),NULL).'">Oui</a>';
                    		} else {
                    			echo 'Oui';
                    		}
                        	
                    		echo ' / ';
                    		
                    		if ($proposition != 2) {
                    			echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-2'),NULL).'">Peut-être</a>';
                    		} else {
                    			echo 'Peut-être';
                    		}
                    		
                    		echo ' / ';
                    		
                    		if ($proposition != 0) {
                    			echo '<a href="'.get_url(array('proposition'=>$user_id_session.'-'.$message['id'].'-0'),NULL).'">Non</a>';
                    		} else {
                    			echo 'Non';
                    		}
                    	} else {
                    		$propositions = select_request_s($link,'proposition',true,'message',$message['id']);
                    		
                    		$votes = array(0,0,0);
                    		foreach ($propositions as $proposition) {
                    			$value = $proposition['proposition'];
                    			if ($value == 0) {
                    				$votes[0]++;
                    			} else if ($value == 1) {
                    				$votes[1]++;
                    			} else if ($value == 2) {
                    				$votes[2]++;
                    			}
                    		}
                    		
                    		echo 'Oui ('.$votes[1].') / Peut-être ('.$votes[2].') / Non ('.$votes[0].')';
                    	}
                } 
                if (!empty($message['dateEvenement'])) {
                    echo '['.$message['dateEvenement'].'] - ';
                }
                ?>
                <span class="icon fa-<?=$types[$message['type']]['icon']?>"></span>
            </div>
            <h3><span class="icon fa-<?=$categorie_icon?>"> <?=$categorie['categorie']?>: <?=$message['title']?></span></h3>
        </header>
			<!-- <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>-->
			<div class="box">
				<?php if($message['images'] != ''):?>
					<span class="image right"><a href="<?=$message['images']?>" class="icon fa-paperclip" style="font-size:30px;" target="_blank"></a></span>
				<?php endif;?>
				<p><?=formatO($message['message'])?></p>
			</div>
			
			<div align="right">
				<?php 
                if ($user['syndic'] == '1') {
                    echo '<span class="icon fa-users"></span> ';
                }
				$user_icon = "user";
				if ($user['proprietaire']) {
					$user_icon = "user-secret";
				}
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
				 - <a class="icon fa-comments-o" href="#message<?=$message['id']?>" onclick="show('commentaires_<?=$message['id']?>')"> Afficher les commentaires (<?=$number_of_comments?>)</a>
				<?php endif;?>
				<?php if ((!$author) && (!in_array($user_id_session,$upVotes))):?>
				 - <a href="<?=get_url(array('upVote'=>$user_id_session.'-'.$message['id']),NULL)?>" class="icon fa-thumbs-o-up" style="color:#01b0f0"> Remercier</a> 
				<?php elseif ($author):
					$numberOfVotes = 0;
					if (count($upVotes) == 1) {
						echo "count 1 [".$message['up_vote']."]";
						if ($message['up_vote'] != '') {
							$numberOfVotes = 1;
							echo "not empty [".$message['up_vote']."]";
						}
					} else {
						echo "More [".$message['up_vote']."]";
						$numberOfVotes = count($upVotes);
					}
				?>
                 - Merci (<?=$numberOfVotes?>)
                <?php endif;?>
				
				<?php if (!$author):?>
				- <a href="<?=get_url(array('favori'=>$user_id_session.'-'.$message['id']),NULL)?>" style="color:#01b0f0" class="icon fa-star<?php if(!in_array($user_id_session,explode(',',$message['favori']))){echo'-o';}?>"> </a> 
				<?php endif;?>
			</div>
			
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
					
					$sender = select_request_s($link,'profils',false,'user_id',$comment['sender']);
					$sender_user = select_request_s($link,'users',false,'id',$comment['sender']);
					
					if ($sender['profil_view'] == 'nom-prenom') {
						$user_comment_link = $sender['prenom'] . ' ' . $sender['nom'];
					}
					else {
						$user_comment_link = 'Appartement n°'.$sender_user['appartement'];
					}
					
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
	</article>
	
	<?php 
	$counter++;
endforeach;
?>
	</div>
	</br>
	<?php 

	if ($number_of_messages > $limit_messages):?>
	<div align="center">
		<ul class="pagination">
			<?php 
			if ($offset == 0){
				echo '<li><span class="button disabled">Prev</span></li>';
			} else {
				$url_page = get_url(array('offset'=>$offset-1),NULL);
				echo '<li><a href="'.$url_page.'" class="button">Prev</a></li>';
			}
			
			for ($j = 0; ($j < round(($number_of_messages / $limit_messages),0,PHP_ROUND_HALF_UP)) ; $j++) {
			
				$url_page = get_url(array('offset'=>$j),NULL);
				
				if ($j == round((($offset*$limit_messages) / $limit_messages), 0, PHP_ROUND_HALF_DOWN)) {
					echo '<li><span class="page active">'.($j+1).'</span></li>';
				}
				else {
					echo '<li><a href="'.$url_page.'" class="page">'.($j+1).'</a></li>';
				}
				//<li><span>&hellip;</span></li>
			}
			
			
			$url_page = get_url(array('offset'=>$offset+1),NULL);
			
			if ($offset != (round(($number_of_messages / $limit_messages),0,PHP_ROUND_HALF_DOWN)-1)) {
				echo '<li><a href="'.$url_page.'" class="button">Next</a></li>';
			} else {
				echo '<li><span class="button disabled">Next</span></li>';
			}
			?>
		</ul>
	</div>
	<?php endif;?>
</section>
<?php endif;?>