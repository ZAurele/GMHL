    <?php if ($number_of_messages > $limit_messages):?>
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