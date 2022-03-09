<?php
$viewMail = '';

if(!isset($profil)){
    $profil = true;
}

$frequence_notifications = select_request($link,"select * from notifications_mails");

if ($profil):
?>

<!-- Form -->
    </br>
    <div class="boxA">
        <a href="<?=get_url(array('passwordChange'=>'1'),NULL)?>" class='icon fa-password'>&#10142; Changer mon mot de passe </a>
    </div>
    
    <form method="post" action="index.php">
        <div class="row uniform">
            </br>
            <div class="12u$">
                <h3 class="icon fa-info"  style="text-decoration: underline;"> Infos pratiques</h3>
            </div>
            
            <div class="4u 12u$(xsmall)">
                <label for="proprio">Je suis: </label>
            </div>
            <div class="4u 12u$(xsmall)">
                <input type="radio" id="proprio" name="country" value='fr' <?php if ($PROFILS['country'] == "fr"){echo'checked';}?>>
                <label for="proprio"><img src="images/fr.svg" class="flag"/> Français</label>
            </div>
            <div class="4u$ 12u$(xsmall)">
                <input type="radio" id="loc" name="country" value='be' <?php if ($PROFILS['country'] == "be"){echo'checked';}?>>
                <label for="loc"><img src="images/be.svg" class="flag"/> Belge</label>
            </div>
            

            </br></br>
            <div class="12u$">
                <h3 class="icon fa-id-card" style="text-decoration: underline;"> Nom / prénom</h3>
            </div>
            
            
            <div class="6u 12u$(xsmall)">
                <input type="text" name="nom" id="nom" value="<?=$PROFILS['nom']?>" placeholder="Nom" />
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="text" name="prenom" id="prenom" value="<?=$PROFILS['prenom']?>" placeholder="Prenom" />
            </div>
            <div class="6u 12u$(xsmall)">
                <input type="radio" id="nom-prenom" name="profil_view" value="nom-prenom" <?php if ($PROFILS['profil_view'] == 'nom-prenom'){echo'checked';}?>>
                <label for="nom-prenom">Afficher nom/prénom</label>
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="radio" id="pseudo" name="profil_view" value="pseudo" <?php if ($PROFILS['profil_view'] != 'nom-prenom'){echo'checked';}?>>
                <label for="pseudo">Afficher le pseudo</label>
            </div>
            
            </br></br>
            <div class="12u$">
                <h3 class="icon fa-envelope-o" style="text-decoration: underline;"> Email</h3>
            </div>
            
            
            <div class="12u$">
                <input type="email" name="email" id="demo-email" value="<?=$PROFILS['email']?>" placeholder="Email" />
            </div>
            <div class="12u$">
            	<input type="hidden" name="email_enable" value="">
                <input type="checkbox" id="email_enable" name="email_enable" <?php if ($PROFILS['email_enable'] == 'on'){echo 'checked';}?>>
                <label for="email_enable">Rendre mon e-mail public aux autres</label>
            </div>

            <!-- Break -->
            <div class="6u">
                <div class="select-wrapper">
                    <select name="frequence_notifications" id="frequence_notifications">
                        <?php
                        foreach ($frequence_notifications as $frequence){
                            $option = '<option value="'.$frequence['id'].'" ';
                            if($PROFILS['frequence_notifications'] == $frequence['id']){
                                $option .= "selected";
                            }
                            $option .= '>'.utf8_encode($frequence['name']).'</option>';
                            echo $option;
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="6u$">
                <b></b>
            </div>

			<div class="4u 12u$(small)">
				<input type="hidden" name="messageMail" value="">
				<input type="checkbox" id="messageMail" name="messageMail" <?php if($PROFILS['messageMail'] == 'on'){echo "checked";}?>>
				<label for="messageMail" ><b class="icon fa-flag" ></b> Me notifier à chaque nouveau message</label>
				
			</div>
			
			<div class="4u 12u$(small)">
				<input type="hidden" name="notificationMail" value="">
				<input type="checkbox" id="notificationMail" name="notificationMail" <?php if($PROFILS['notificationMail'] == 'on'){echo "checked";}?>>
				<label for="notificationMail"><b class="icon fa-comments-o" ></b> Me notifier à chaque nouvelle notification</label>
				
			</div>
			
			<div class="4u 12u$(small)">
				<input type="hidden" name="privateMail" value="">
				<input type="checkbox" id="privateMail" name="privateMail" <?php if($PROFILS['privateMail'] == 'on'){echo "checked";}?>>
				<label for="privateMail"><b class="icon fa-envelope-o" ></b> Me notifier à chaque nouveau message privé</label>
				
			</div>
        
            
            </br></br>
            <div class="12u$">
                <h3 class="icon fa-id-badge" style="text-decoration: underline;"> Infos perso</h3>
            </div>
            
            <div class="12u$">
                <textarea name="description" id="description" placeholder="Description"  rows="6"><?=$PROFILS['description']?></textarea>
            </div>
            <!-- Break -->
            <div class="12u$">
                <ul class="actions">
                    <input type="hidden" name="action" value="updateProfil">
                    <li><input type="submit" value="Mettre à jour" class="special" /></li>
                </ul>
            </div>
        </div>
    </form>
<?php else:?>
    </br>
    <form method="post" action="?page=profil">
        
        <label>Mot de passe actuel:</label>
        <input type="password" name="oldpassword"/><br/>
        
        <label>Nouveau mot de passe :</label>
        <input type="password" name="password1"/><br/>
        
        <label>Nouveau mot de passe :</label>
        <input type="password" name="password2"/><br/>
        
        <input type="hidden" name="action" value="updatePassword">
        <input type="submit" value="Valider"/>
        
    </form>
<?php endif;?>