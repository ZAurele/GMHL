<ul>
    <li><a href="index.php?home=1" class="icon fa-check-square-o" > Tous</a></li>
    <li><a href="?page=messages&amp;nonVu=0" class="icon fa-square-o"> Déja vus</a></li>
    
    <li><a href="?page=message" class="icon fa-plus" style="color:green"> Nouveau</a></li>
    <li><a href="?page=messages&amp;favoris=1" class="icon fa-star"> Favoris</a></li>
    
    <li>
        <span class="opener"><span class="icon fa-asterisk"> Par type</span></span>
        <ul>
        <?php 
            foreach ($types as $key => $type) {
                $icon = 'class="icon fa-'.$type['icon'].'"';
                
                $url = '?page=messages&amp;type='.$key;
                echo '<li><a href="'.$url.'" '.$icon.'> '.$type['text'].'</a></li>';
            }
        ?>
        </ul>
    </li>
    <li>
        <span class="opener"><span class="icon fa-bars"> Par categories</span></span>
        <ul>
        <?php 
            $categories = select_request_s($link,'categories',true,NULL,NULL);
            foreach ($categories as $categorie) {
                $icon = "";
                if (isset($categorie['icon'])) {
                    $icon = 'class="icon fa-'.$categorie['icon'].'"';
                }
                
                $url = '?page=messages&amp;categorie='.$categorie['id'];
                echo '<li><a href="'.$url.'" '.$icon.'> '.$categorie['categorie'].'</a></li>';
            }
        ?>
        </ul>
    </li>

    
</ul>