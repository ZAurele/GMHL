<?php if ($logged) :?>
     <a href="index.php" class="logo"><strong> <?=$project?> 
     <?php if (isset($etat_chauffage)):?>
        (<span style="color:<?=$etat_chauffage['couleur']?>;" class="icon fa-thermometer">  <?=$etat_chauffage['complement']?></span>
        - <span style="color:<?=$etat_eau['couleur']?>;" class="icon fa-shower">  <?=$etat_eau['complement']?></span> 
        - <span style="color:<?=$etat_chauffage['couleur']?>;" class="icon fa-bolt">  <?=$etat_chauffage['complement']?></span>
        - <span style="color:<?=$etat_ascenseur['couleur']?>;" class="icon fa-cogs">  <?=$etat_ascenseur['complement']?></span>
        )
    <?php endif;?>
    :</strong> 
    <span class="icon fa-building-o"> Appartement <?=$appartement?></span>
    - 
    <span class="icon fa-user-circle"> <?=$profils_infos['nom']?></span> <?=$profils_infos['prenom']?></a>
        
    <ul class="icons">
        <li>
            <b><a href="?page=messages&amp;nonVu=1" class="icon fa-flag" <?php if ($uMessages_counter!=0){echo 'style="color:green"';}?>>
            	 <?=$uMessages_counter?>
            </a></b>
        </li>
        <li>
            <b><a href="?page=messages&amp;nonVuC=1" class="icon fa-comments-o" <?php if ($comments_counter!=0){echo 'style="color:green"';}?>>
            	 <?=$comments_counter?>
            </a></b>
        </li>
        <li>
            <b><a href="?page=messages&amp;private=1" class="icon fa-envelope-o" <?php if ($uPrivateMessages_counter!=0){echo 'style="color:green"';}?>> 
            <?=$uPrivateMessages_counter?></a></b>
        </li>
    </ul>
<?php else:?>
    <img src="images/GMHL_Logo.png" class="logo"/>

<?php endif;?>