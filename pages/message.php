<?php
$categories = select_request_s($link,'categories',true,NULL,NULL);

// MESSAGE
$to = NULL;
if (isset($_GET['to'])) {
	$to = $_GET['to'];
}


$message = '';
if ($uploaded_file['erreur'] != '' && $uploaded_file['erreur'] != NULL) {
	$message = $uploaded_file['message'];
} elseif ($message_envoye) {
	$message = 'Message envoyé !';
} else {
	if ($error_message != '') {	
		$message = $error_message;
	}
}

if($to != NULL) {
    if ($message != '') {
        $message .= '</br></br>';
    }
    $message .= 'Message à '.get_user_pseudo($to);   
}

if ($message != ''):
	?>
	</br>
	<div class="box">
		<b style="color:green"><?=$message?></b>
	</div>
	<?php 
endif;

if(!$message_envoye):?>
<!-- Form -->
	<form method="post" action="#" enctype="multipart/form-data">
    <br/>
		<div class="row uniform">
        
            <?php if($to == NULL):?>
			<div class="12u$">
				<h4>Categorie</h4>
			</div>
			
			<!-- Break -->
			<div class="6u 12u(small)">
				<div id="categorieOn">
					<div class="select-wrapper">
						<select name="categorie" id="categorie">
	                        <?php
	                        
	                        foreach ($categories as $categorie) {
	                        	$checked = "";
	                        	$cat_id = $categorie['id']; 
	                        	
                        		if (intval($posts['categorie']) == $cat_id) {
                        			echo "<option value=$cat_id selected>";
                        		} else {
	                        		echo "<option value=$cat_id>";
                        		}
	                        	echo $categorie['categorie'];
	                            echo "</option>";
	                        }
	                        ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="6u$ 12u(small)">
				<div id="categorieOnButton">
					<b>OU &nbsp;&nbsp;</b>
					<button type="button" onClick = "show('categorieOn');show('categorieOff');show('categorieOnButton');show('categorieOffButton')">Nouvelle categorie</button>
            	</div>
            </div>
            
			<div class="6u 12u(small)">
				<div id="categorieOff" style="display:none;">
					<input type="text" name="nouvelle_categorie" maxlength="30" id="nouvelle_categorie" value="" placeholder="Nouvelle categorie" />
				</div>
			</div>
			
			<div class="6u$ 12u(small)">
				<div id="categorieOffButton" style="display:none;">
					<b>OU &nbsp;&nbsp;</b>
					<button type="button" onClick = "show('categorieOn');show('categorieOff');show('categorieOnButton');show('categorieOffButton')">Categorie existante</button>
				</div>
			</div>
			
            <?php endif;?>
            
            <div class="12u">
            	<h4>Message</h4>
            </div>
            
            <div class="12u$">
				<input type="text" name="title" id="title" value="<?=$posts['title']?>" placeholder="Titre" />
			</div>
			
			<div class="12u$">
				<textarea name="message" id="message" placeholder="Entrer votre message" rows="6"><?=$posts['message']?></textarea>
			</div>
            
            <div class="12u">
            	<h4>Importance</h4>
            </div>
            
			<!-- Break -->
			<div class="4u 12u$(small)">
				<input type="radio" id="faible_prio" name="priority" value="faible" <?php if ($posts['priority'] == 'faible') {echo 'checked';}?>>
				<label for="faible_prio"><b class="faibleColor">Faible</b></label>
			</div>
			<div class="4u 12u$(small)">
				<input type="radio" id="normal_prio" name="priority" value="normal" <?php if ($posts['priority'] == 'normal') {echo 'checked';}?>>
				<label for="normal_prio"><b class="normalColor">Normal</b></label>
			</div>
			<div class="4u$ 12u$(small)">
				<input type="radio" id="forte_prio" name="priority" value="forte" <?php if ($posts['priority'] == 'forte') {echo 'checked';}?>>
				<label for="forte_prio"><b class="forteColor">Forte</b></label>
			</div>
			
            <?php if($to == NULL):?>
            <div class="12u">
            	<h4>Type</h4>
            </div>
            
			<!-- Break -->
			<?php
			$i = 1;
			$size = sizeof($types);
			foreach ($types as $key => $type):
				if ($i != $size):
					?>
					<div class="4u 12u$(small)">
					<input type="radio" id="<?=$key?>_type" name="type" value="<?=$key?>" <?php if($key==$posts['type']){echo "checked";}?>>
					<label for="<?=$key?>_type"><span class="icon fa-<?=$type['icon']?>"> <?=$type['text']?></span></label>
					</div>
					<?php 
				else:
					?>
					<div class="4u$ 12u$(small)">
					<input type="radio" id="<?=$key?>_type" name="type" value="<?=$key?>" <?php if($key==$posts['type']){echo "checked";}?>>
					<label for="<?=$key?>_type"><span class="icon fa-<?=$type['icon']?>"> <?=$type['text']?></span></label>
					</div>
					<?php 					
				endif;
				
				$i++;
			endforeach;
			?>	
            <div class="12u">
            	<h4>Date</h4>
            </div>
			<div class="6u 12u$(small)">
				<input type="checkbox" id="activateDate" name="activateDate" onClick="show('dateBlock')" <?php if(isset($posts['dateEvenement'])){if($posts['dateEvenement'] != NULL){echo "checked";}}?>>
				<label for="activateDate">Ajouter une date</label>
			</div>
			<div class="6u$ 12u$(small)" id="dateBlock" <?php if(isset($posts['dateEvenement'])){if(!$posts['dateEvenement'] != NULL){echo 'style="display:none;"';}}else{echo 'style="display:none;"';}?>>
				<input type="date" name="dateEvenement" id="dateEvenement" value="<?=date_default_timezone_set('Y-m-d')?>"/>
			</div>
			<?php endif;?>
			
            <div class="12u">
            	<h4>Image / fichier</h4>
            </div>
            
            <?php 
            if(isset($posts['images'])):
	            if($posts['images'] != ''):?>
					<div class="6u 12u$(small)">
						<input type="checkbox" id="changeFile" name="changeFile" onClick="show('newImage');show('fileBlock')">
						<label for="changeFile">Changer l'image / le fichier</label>
					</div>
					<div class="6u$ 12u$(small)"><a href="<?=posts['images']?>" class="icon fa-paperclip" style="font-size:30px;" target="_blank"></a></div>
				<?php 
				endif;
			endif;
			?>
            
			<div class="6u 12u$(small)" id="newImage" <?php if(isset($posts['images'])){if($posts['images'] != ''){echo 'style="display:none;"';}}?>>
				<input type="checkbox" id="activateFile" name="activateFile" onClick="show('fileBlock')" <?php if(isset($posts['images'])){ if($posts['images'] != ''){echo "checked";}}?>>
				<label for="activateFile">Ajouter une image / un fichier</label>
				<b> (<?php $i=0;foreach($extensions_valides_images as $ext){
					if ($i != 0){
						echo ', ';
					}
					echo $ext;
					$i++;}
					?>)
				</b>
			</div>
			
			<div class="6u$ 12u$(small)" id="fileBlock" style="display:none;">
				<b>(Max <?=formatBytes($file_max_size_upload)?>)</b>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?=$file_max_size_upload?>" />
				<input type="file" name="file_upload" id="file_upload" />
			</div>

			<!-- Break -->
			<div class="12u$">
				<ul class="actions">
					<li><input type="submit" value="Envoyer le message" class="special" /></li>
					<li><input type="reset" value="Effacer" /></li>
                    <input type="hidden" name="action" value="sendMessage">
                    <input type="hidden" name="id" value="<?=$posts['unique_id']?>">
                    <input type="hidden" name="to" value="<?=$to?>">
                    <input type="hidden" name="user_id" value="<?=$_SESSION['login_id']?>">
				</ul>
			</div>
		</div>
	</form>
<?php endif;?>