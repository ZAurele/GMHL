<?php if ($logged) :?>
    <img src="images/BANDEROLLE.svg" class="logo-large"/>
    <p><br></p>

    <a href="index.php?page=profil" class="profil"><p><br></p>

    <span class="icon fa-user-circle"> <img src="images/<?=$PROFILS['country']?>.svg" class="flag-small"/> <?=$PSEUDO?></span> </a>
   
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