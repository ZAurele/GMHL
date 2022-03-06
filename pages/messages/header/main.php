<!--  HEADER -->
<header class="<?=$prio_style?>" id="message<?=$message['id']?>">            
            <div align="right"style="float:right" class="boxA">
                <?php 
                switch($message['type']) {
                    case 'evenement':
                        break;
                    case 'travaux':
						include 'travaux.php';
                        break;
                    case 'proposition':
                        include 'proposition.php';
                        break;
                } 
                
                if (!empty($message['dateEvenement'])) {
                    echo '['.$message['dateEvenement'].'] - ';
                }
                ?>
                <span class="icon fa-<?=$types[$message['type']]['icon']?>"></span>
            </div>
            
   <h3><span class="icon fa-<?=$categorie_icon?>"> <?=$categorie['categorie']?>: <?=$message['title']?></span></h3>
</header>