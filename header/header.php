<?php if ($logged) :?>
    <img src="images/BANDEROLLE.svg" class="logo-large"/>

    <a href="index.php?page=profil" class="profil"><p><br></p>

    <span class="icon fa-user-circle"> <img src="images/<?=$PROFILS['country']?>.svg" class="flag-small"/> <?=$PSEUDO?></span> </a>
   
    <ul class="icons" style="display:none;">
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

    <?php if($logged):?>
    <section id="logout">
        <form action="" method="post">
            <input type="submit" value="Se déconnecter" name="logout" width="100%" class="button small fit"/>
        </form>
    </section>
    <?php endif; ?>

<?php elseif (!isset($_GET["page"]) || $_GET["page"] != "login"):?>
    <img src="images/BANDEROLLE.svg" class="logo-large"/>

    <div id="login">
        <i class="icon fa-user"></i><a href="?page=login">Se connecter</a>
    </div>

<?php endif;?>
