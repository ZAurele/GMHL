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
                <h3 class="icon fa-id-card" style="text-decoration: underline;"> Nom / prénom</h3>
            </div>
            
            
            <div class="6u 12u$(xsmall)">
                <input type="text" name="nom" id="nom" value="<?=$profils_infos['nom']?>" placeholder="Nom" />
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="text" name="prenom" id="prenom" value="<?=$profils_infos['prenom']?>" placeholder="Prenom" />
            </div>
            <div class="6u 12u$(xsmall)">
                <input type="radio" id="nom-prenom" name="profil_view" value="nom-prenom" <?php if ($profils_infos['profil_view'] == 'nom-prenom'){echo'checked';}?>>
                <label for="nom-prenom">Afficher nom/prénom</label>
            </div>
            <div class="6u$ 12u$(xsmall)">
                <input type="radio" id="appartement" name="profil_view" value="appartement" <?php if ($profils_infos['profil_view'] != 'nom-prenom'){echo'checked';}?>>
                <label for="appartement">Afficher le numéro d'appartement</label>
            </div>
            
            </br></br>
            <div class="12u$">
                <h3 class="icon fa-envelope-o" style="text-decoration: underline;"> Email</h3>
            </div>
            
            
            <div class="12u$">
                <input type="email" name="email" id="demo-email" value="<?=$profils_infos['email']?>" placeholder="Email" />
            </div>
            <div class="12u$">
            	<input type="hidden" name="email_enable" value="">
                <input type="checkbox" id="email_enable" name="email_enable" <?php if ($profils_infos['email_enable'] == 'on'){echo 'checked';}?>>
                <label for="email_enable">Rendre mon e-mail public aux autres résidents</label>
            </div>

            <!-- Break -->
            <div class="6u">
                <div class="select-wrapper">
                    <select name="frequence_notifications" id="frequence_notifications">
                        <?php
                        foreach ($frequence_notifications as $frequence){
                            $option = '<option value="'.$frequence['id'].'" ';
                            if($profils_infos['frequence_notifications'] == $frequence['id']){
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
				<input type="checkbox" id="messageMail" name="messageMail" <?php if($profils_infos['messageMail'] == 'on'){echo "checked";}?>>
				<label for="messageMail" >Me notifier à chaque nouveau message</label>
				<b class="icon fa-flag" ></b>
			</div>
			
			<div class="4u 12u$(small)">
				<input type="hidden" name="notificationMail" value="">
				<input type="checkbox" id="notificationMail" name="notificationMail" <?php if($profils_infos['notificationMail'] == 'on'){echo "checked";}?>>
				<label for="notificationMail">Me notifier à chaque nouvelle notification</label>
				<b class="icon fa-comments-o" ></b>
			</div>
			
			<div class="4u 12u$(small)">
				<input type="hidden" name="privateMail" value="">
				<input type="checkbox" id="privateMail" name="privateMail" <?php if($profils_infos['privateMail'] == 'on'){echo "checked";}?>>
				<label for="privateMail">Me notifier à chaque nouveau message privé</label>
				<b class="icon fa-envelope-o" ></b>
			</div>
            
            </br></br>
            <div class="12u$">
                <h3 class="icon fa-info"  style="text-decoration: underline;"> Infos pratiques</h3>
            </div>
            
            <div class="4u 12u$(xsmall)">
                <label for="proprio">Je suis: </label>
            </div>
            <div class="4u 12u$(xsmall)">
                <input type="radio" id="proprio" name="proprietaire" value='1' <?php if ($profils_infos['proprietaire']){echo'checked';}?>>
                <label for="proprio"><span class="icon fa-user-secret"> </span>Propriétaire</label>
            </div>
            <div class="4u$ 12u$(xsmall)">
                <input type="radio" id="loc" name="proprietaire" value='0' <?php if (!$profils_infos['proprietaire']){echo'checked';}?>>
                <label for="loc"><span class="icon fa-user"> </span>Locataire</label>
            </div>
            
            <div class="4u 12u$(xsmall)">
                <label for="proprio">Je suis au syndicat: </label>
            </div>
            <div class="4u 12u$(xsmall)">
                <input type="radio" id="syndicN" name="syndic" value='1' <?php if ($profils_infos['syndic']){echo'checked';}?>>
                <label for="syndicN"><span class="icon fa-users"> </span>Oui</label>
            </div>
            <div class="4u$ 12u$(xsmall)">
                <input type="radio" id="syndicY" name="syndic" value='0' <?php if (!$profils_infos['syndic']){echo'checked';}?>>
                <label for="syndicY"><span class="icon fa-user"> </span>Non</label>
            </div>
        
            <!-- 
            <div class="4u 12u$(xsmall)">
                Etage : 
            </div>
            <div class="4u$ 12u$(xsmall)">
                    <select name="etage" id="etage">
                        <?php
                        /*for ($i=0; $i <=9; $i++) :
                            $checked = "";
                            
                            if ($profils_infos['etage'] != null) {
                                if ($profils_infos['etage'] == $i) {
                                    $checked = "checked";
                                }
                            }
                            ?>
                            <option value="<?=$i?>" <?=$checked?>>
                            <?php if($i ==0){echo 'RDC';}else{echo $i." ème étage";}?>
                            </option>
                        <?php 
                            endfor;
                        */?>
                    </select>
            </div>
            -->
            
            </br></br>
            <div class="12u$">
                <h3 class="icon fa-id-badge" style="text-decoration: underline;"> Infos perso</h3>
            </div>
            
            <div class="12u$">
                <textarea name="description" id="description" placeholder="Description"  rows="6"><?=$profils_infos['description']?></textarea>
            </div>
            <!-- Break -->
            <div class="12u$">
                <ul class="actions">
                    <input type="hidden" name="action" value="updateProfil">
                    <input type="hidden" name="appartement" value="<?=$appartement?>">
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