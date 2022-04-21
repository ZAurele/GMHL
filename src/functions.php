<?php 

function report_sql($sql) {	
    debug($sql);
}

function validateDate($date){    
    $d = DateTime::createFromFormat('Y-m-d', $date);    
    return $d && $d->format('Y-m-d') === $date;
}



function get_user_pseudo($id) {
    $user_infos = select_request_s($GLOBALS['link'],'profils',false,'user_id',$id);   
    if($user_infos==null) return '';
    if ($user_infos['profil_view'] == 'nom-prenom') {        
        return $user_infos['prenom'].' '.$user_infos['nom'];    
    }    
    $user = select_request_s($GLOBALS['link'],'users',false,'id',$id); 
    return $user['username'];
}

function formatO($text) {    
    return nl2br(htmlentities($text));
}

function format($value) {	
    return mysqli_real_escape_string($GLOBALS['link'],str_replace('\n','<br>',$value));
}

function delete_request($link,$table,$key,$value){
	$sql = "DELETE FROM `".$table."` WHERE `".$key."` = '".$value."'";		
    $req = mysqli_query($link,$sql);	
    if (!$req){		
        report_sql(mysqli_error($link));		
        return NULL;	
    }
}

function get_url($gets,$page) {	
    // clean 		
    $amp = '&amp;';	
    $url_page = '?';		
    $i = 0;		
    #debug($_SERVER['QUERY_STRING']);		
    foreach (
        $GLOBALS['permanent_url'] as $permanent
    ) {		
        $value = '';		
        if (strstr($_SERVER['QUERY_STRING'],$permanent)) {			
            $temp = explode($permanent.'=',$_SERVER['QUERY_STRING'])[1];			
            $value = explode('&',$temp)[0];		
        }				
        if ($value != '') {			
            if ($i != 0) {				
                $url_page .= $amp;			
            }			
            $url_page .= $permanent.'='.$value;			
            $i++;		
        }		
        #debug($url_page);	
    }		
    $i = 0;	
    foreach ($gets as $key => $value) {		
        if ($url_page != '?' || $i != 0) {			
            $url_page .= $amp;		
        }		
        $url_page .= $key.'='.$value;		
        $i++;	
    }	
    
    /*	if($_SERVER['QUERY_STRING'] != ''){		
        if (strstr($_SERVER['QUERY_STRING'],$key)) {						
            $before = explode($key.'=',$_SERVER['QUERY_STRING'])[0];			
            $middle = explode($key.'=',$_SERVER['QUERY_STRING'])[1];			
            $after = '';						
            if (strstr($_SERVER['QUERY_STRING'],'&amp;')) {				
                $after = explode('&amp;',$middle)[1];				
                $url_page = '?'.$before.$key.'='.$value.'&amp;'.$after;			
            } else{				
                $url_page = '?'.$before.$key.'='.$value;			
            }					
        } else {			
            $url_page = '?'.$_SERVER['QUERY_STRING'].'&amp;'.$key.'='.$value;		
        }
    }	else{		
        $url_page = '?'.$key.'='.$value;	
    }	*/		
    
    if ($page != null) {		
        return $page.$url_page;	
    } else {		
        return $url_page;	
    }
}

function get_url2($gets,$page) {	
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);		
    return get_url($gets,null).$page;
}

function debug($text) {	
    error_log(date("Y-m-d H:i:s")."> ".$text."\n", 3, "./log/debug.log");
}

function formatBytes($size, $precision = 2){	$base = log($size, 1024);	$suffixes = array('', 'K', 'M', 'G', 'T');	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];}

function genererPseudo($caracteres=5,$type=1){
    //le mot final sera composé par des consonnes et voyelles, afin de faire un nom lisible on mettra des consonnes puis des voyelles, puis deux voyelles (aléatoirement) puis une consonne, etc...)
    //lettres qui vont être utilisées
    //le type 1 comporte toutes les lettres de l'alphabet
    if($type==1){
        $Consonnes=['qu','b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w','x','z'];
        $Voyelles=['a','e','i','o','u','y'];
    }
    //le type 2 comporte des lettres en moins: j, x, z, y pour un consonance moins asiatique
    elseif($type==2){
        $Consonnes=['qu','b','c','d','f','g','h','k','l','m','n','p','r','s','t','v','w'];
        $Voyelles=['a','e','i','o','u'];
    }
    //pour les deux types suivants, il est évident que le nombre de caractère sera plus élevé car à la place d'une lettre on à jusqu'à trois lettre ensemble
    //le type 3 contient des portions de noms viking, afin d'en composer un nouveau
    elseif($type==3){
        $Consonnes=['alb','alr','are','ast','axe','axi','ber','bjo','bre','bri','bru','cyb','dag','dav','eli','els','elv','eri','ery','fre','gal','ger','gre','gud','gun','gus','har','hed','hel','hil','ing','jan','jen','jor','kar','kri','lar','lei','len','loa','lud','vig','lyn','mai','man','mar','mat','my','nik','nil','nis','odi','ola','osc','rol','san','sig','smi','sol','sor','sve','swa','tho','tyr','ulr','urs','val','van','yor'];
        $Voyelles=['ick','ik','en','id','el','il','da','it','ta','de','er','le','ar','in','sa','ka','ic','is','on','ya','ja','rd','ld','go','rg','ge','na','of','an','rt','aé','if','oa','ki','va','ig','ed','ny','my','as','ey','nn','or','ra'];
    }
    //le type 4 contient des préfixes de mots à la places des consonnes, on dirait des noms de médicament :P
    elseif($type==4){
        $Consonnes=['en','em','in','im','ex','mi','sub','re','ac','af','al','ap','co','de','ex'];
        $Voyelles=$Consonnes;
    }
    $pasDeuxFois=['x','w','v','h','i','u','y'];//lettres qu'on ne veut pas deux fois de suite
    $NbrDeConsonnes=count($Consonnes)-1;//on compte combien il y a de consonnes
    $NbrDeVoyelles=count($Voyelles)-1;//on compte combien il y a de voyelles
    // On génère le pseudo
    $pseudo='';//on initialise notre variable pseudo, on viendra y rajouter caractère par caractère pour le construire
    $mettre='consonne';//on commence par mettre une consonne
    $cv=0;//cv pour "compter voyelle" (au bout de deux maximum on repassera à consonne)
    for($i=0;$i<=$caracteres-1;$i++){
        if($mettre=='consonne'){
            //on vérifie que ça termine pas par "qu"
            do{
                $caractere=$Consonnes[rand(0,$NbrDeConsonnes)];
            }while($caractere=='qu' AND ($i+1)==$caracteres);
            if($caractere=='qu')$i+=1;//on compte deux caractères au lieu d'un pour "qu"
            $mettre='voyelle';//on repasse à voyelle
            $pseudo .= $caractere;//on choisi une consonne aléatoirement
            
        } elseif($mettre=='voyelle'){
            //on vérifie si le nouveau caractères utilisé n'est pas un qui est interdit à la suite, dans $pasDeuxFois
            do{
                $caractere=$Voyelles[rand(0,$NbrDeVoyelles)];
            } while((substr($pseudo,-1)==$caractere) AND in_array(substr($pseudo,-1),$pasDeuxFois));
            //c'est un caractère autorié, on l'ajoute au pseudo
            $pseudo .= $caractere;
            //si on arrive à un maximum de 2 voyelle à la suite, on passe au consonne
            if($cv==2){
                $mettre='consonne';
                continue;//on passe à la prochaine itération (soit; une consonne)
            }
            //une chance sur deux de passer à consonne
            if(rand(1,2)==1) $mettre='consonne';
            //sinon on compte les voyelles pour qu'à la deuxième maximum on repasse à consonne
            $cv+=1;
        }
    }
    return $pseudo;
}

function capitalize($s) {
    return mb_strtoupper( mb_substr( $s, 0, 1 )) . mb_substr( $s, 1 );
}

function is_localhost() {
	return true;
	$whitelist = array( '127.0.0.1', '::1' );
	if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
		return true;
}
?>