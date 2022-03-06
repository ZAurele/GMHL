<?php 

if($logged):
    $user_selected = select_request_s($link,'users',false,'id',$user_id_session);
    $current_time = date('Y-m-d G:i:s');
    
    if (strcmp(explode(' ',$user_selected['modificationTime'])[0],explode(' ',$current_time)[0]) != 0) {
        update_request(array('modificationTime'=>$current_time),$link,'users','id',$user_id_session);
    }
    ?>
<?php include 'data/gets/private.php';?>
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

$limit_messages = 5;
$counter = 1;
//$number_of_messages = sizeof($messages);

$offset = 0;
if (isset($_GET['offset'])) {
    $offset = $_GET['offset'];
}

$number_of_messages = 0;

foreach ($messages as $message):
	
	$messageRead = !in_array($message['id'],explode(',',$rMessages));
	
	include 'messages/comments/rComments.php';
	
    $author = false;

    if ($message['user_id'] == $user_id_session){
        $author = true;
    }

    if (isset($_GET['private'])) {
        if ($_GET['private']) {
            if (!$message['private']){ 							// PUBLIC
                continue;
            } else { 											// PRIVATE
                if (
                	!(($message['private'] == $user_id_session) || ($message['user_id'] == $user_id_session))
                ) {
                    continue;
                }
                
                if (isset($_GET['archive'])){
                    if ($messageRead && !$_GET['archive']) {
                        continue;
                    } elseif (!$messageRead && $_GET['archive']) {
                        continue;
                    }
                } else {
                	debug('Message: '.$messageRead .' comment: '. $commentsRead.' id: '.$message['id']);
                    if ($messageRead && $commentsRead) {
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
    
    if (isset($_GET['nonVu']) || $_SESSION['nonVu']) {
        if ( ($messageRead || ($message['user_id'] == $user_id_session)) && $_SESSION['nonVu']){
            continue;
        } elseif ( (!$messageRead || $message['user_id'] == $user_id_session) && !$_SESSION['nonVu']){
            continue;
        }
    }
    
    if (isset($_GET['nonVuC']) || $_SESSION['nonVuC']) {
    	if ( $commentsRead && $_SESSION['nonVuC']){
    		continue;
    	} elseif ( !$commentsRead && !$_SESSION['nonVuC']){
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
			<?php include 'messages/header/main.php';?>
			
            <!-- <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>-->
            <div class="box">
                <?php if($message['images'] != ''):?>
                    <span class="image right"><a href="<?=$message['images']?>" class="icon fa-paperclip" style="font-size:30px;" target="_blank"></a></span>
                <?php endif;?>
                <p><?=formatO($message['message']);?></p>
            </div>
            
            <?php include 'messages/footer/main.php';?>
            
			<?php include 'messages/comments/main.php';?>
    </article>
    <br>
    <div align="center"><a href="#header" class="button"><b class="icon fa-arrow-up"></b></a></div>
    <?php $counter++; endforeach;?>
	
    </div>
    </br>
    
	<?php include 'messages/pagesScroller.php';?>
</section>
<?php endif;?>