<p style="text-align:center"> <i>Cette évaluation vous fournit <b> un premier regard </b>sur les principaux axes d’amélioration de votre exploitation dans un 
contexte de prédation et donc des pistes de réflexions pour vous protéger au mieux. L’outil du CERP est porté par plusieurs 
structures qui peuvent venir vous aider (conseils chiens de protections, clôtures, etc.) que vous pourrez trouver sur l’onglet 
à gauche <b>«Les acteurs »</b> puis <b>«Trombinoscope »</b>.</i> </p>

<p style="text-align:justify">

Vous avez la possibilité de bénéficier d’aides financières pour mettre en place les moyens de protections. Afin de connaitre les aides auxquelles vous êtes éligibles, vous pouvez vous rendre sur la barre à gauche, sur « Ressources » puis « Connaître mes droits ».  
</p>
<?php 

$sql = "SELECT id FROM users where mean != 1";
$rows = select_request($link,$sql,true);
$USER_ID_EXCEPTIONS = implode(',',array_unique(array_map(fn($value): string => $value["id"], $rows)));

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    
    if($USER_ID_EXCEPTIONS != '')
        $sql = "SELECT * FROM questionnaires where user_id != ".$USER_ID." and user_id not in (".$USER_ID_EXCEPTIONS.") and category = '".$category."' and `env` = '".$ENV."' order by id DESC";
    else
    $sql = "SELECT * FROM questionnaires where user_id != ".$USER_ID." and category = '".$category."' and `env` = '".$ENV."' order by id DESC";
    $rows = select_request($link,$sql,true);
    
    $scores = get_scores_from_database($QUESTIONS, $category, $rows);  

    $scores_all = array();
    
    foreach($VERSIONS as $version => $dates) {
        $scores_all[$version] = array();
        foreach($QUESTIONS[$category]["values"] as $type => $cf) {
            $scores_all[$version][$type] = array("low"=>0, "high"=>0, "name" =>$type);
        }

        $sql = "SELECT * FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' and number = '".get_selected_nb($category)."' and version = ".$version." and `env` = '".$ENV."' order by id DESC";
        $rows_user = select_request($link,$sql,true);

        $scores_user = get_scores_from_database($QUESTIONS, $category, $rows_user);

        foreach($scores as $type => $scores_ids) {
            $sum_cat = 0;
            $sum_bareme = 0;

            foreach($scores_ids as $id => $val) {
                if (strtoupper(trim(''.$val)) != 'NA') {
                    $sum_bareme += $SCORES_MAX[$category][$type][$id];
                    //echo 'value ('.$val.')<br/>';
                    $sum_cat += $val;
                }
            }

            $scores_all[$version][$type]["high"] = round(($sum_cat / $sum_bareme)*100);
        }
        foreach($scores_user as $type => $scores_ids) {
            $sum_cat = 0;
            $sum_bareme = 0;

            foreach($scores_ids as $id => $val) {
                if (strtoupper(trim(''.$val)) != 'NA') {
                    $sum_bareme += $SCORES_MAX[$category][$type][$id];
                    $sum_cat += $val;
                }
            }

            $scores_all[$version][$type]["low"] = round(($sum_cat / $sum_bareme)*100);
        }
    }

    $error = '';

    if (isset($QUESTIONS[$category]["multi"])) {
        $sql = "SELECT * FROM questionnaires_names where `env` = '".$ENV."' and user_id = ".$USER_ID." and category = '".$category."' order by number DESC";
        $rows = select_request($link,$sql,true);

        $default = $QUESTIONS[$category]["multi"].' principale';
        $selected = $default;
        if($rows != null) {
            foreach($rows as $row):
                if(get_selected_nb($category)==$row["number"]) 
                    $selected = $QUESTIONS[$category]["multi"].' '.$row["name"];
            endforeach;
        }

        if(!isset($_GET["add"])): // Mode selection de parcelle 
            if(isset($_GET["delete"])) { // delete parcelle
                $sql = "DELETE FROM `questionnaires_names` WHERE `env` = '".$ENV."' and `number` = '".$_GET['delete']."' and `category` = '".$category."'";		
                $req = mysqli_query($link,$sql);	

                $sql = "DELETE FROM `questionnaires` WHERE `env` = '".$ENV."' and `number` = '".$_GET['delete']."' and `category` = '".$category."'";		
                $req = mysqli_query($link,$sql);	

                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                        || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
                header($header.'Location: '.$protocol.$_SERVER['HTTP_HOST'].str_replace('selected=','',str_replace('delete=','',$_SERVER['REQUEST_URI'])).'&selected=1');
            }
            ?>

            <h3><?=$QUESTIONS[$category]["multi"]?>:</h3>
            <div style="display:flex;">
                <select onChange="changedMulti(this.value)" name="choice-<?=$category?>" style="margin-right:10px">
                    <option value="1" <?php echo get_selected_nb($category)=="1" ? "selected":""?>><?=$default?></option>

                    <?php foreach($rows as $row):
                        $is_selected = get_selected_nb($category)==$row["number"];
                        ?>
                        <option value="<?=$row["number"]?>" <?php echo $is_selected ? "selected":""?>><?=$QUESTIONS[$category]["multi"]?> <?=$row["name"]?></option>
                    <?php endforeach; ?>
                </select>
                <div style="display:flex;flex-direction:column">
                    <form method="get" action="#" style="margin-bottom:5px">
                        <input type="hidden" name="add" value=""/>
                        <input type="hidden" name="page" value="results"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Ajouter une parcelle" style="width:200px;box-shadow: inset 0 0 0 2px #2ecc71;color:#2ecc71 !important;" class="button small fit"/>
                    </form>
                    <form method="get" action="#" style="margin-bottom:5px">
                        <input type="hidden" name="add" value="duplicate"/>
                        <input type="hidden" name="page" value="results"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Copier la parcelle" style="width:200px;box-shadow: inset 0 0 0 2px #2980b9;color:#2980b9 !important;" class="button small fit"/>
                    </form>
                    <?php if($selected != $default):?>
                        <form method="get" action="#" style="margin-bottom:5px">
                            <input type="hidden" name="delete" value="<?=get_selected_nb($category)?>"/>
                            <input type="hidden" name="page" value="results"/>
                            <input type="hidden" name="category" value="<?=$category?>"/>
                            <input type="submit" value="Supprimer la parcelle" style="width:200px;box-shadow: inset 0 0 0 2px #e74c3c;color:#e74c3c !important;" class="button small fit"
                            onclick="return confirm('Confirmez vous la suppression de <?=$selected?>.');"/>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php 
        else: // mode ajout de parcelle
            if(isset($_POST["multi"])) {
                $names = array();
                $numbers = array();
                if ($rows != null) {
                    $names = array_unique(array_map(fn($value): string => $value["name"], $rows));
                    $numbers = array_unique(array_map(fn($value): int => $value["number"], $rows));
                }

                $nb = count($numbers) != 0 ? max($numbers) : 1;
    
                if(!in_array($_POST["multi"], $names) && strlen($_POST["multi"]) > 3) {
                    $values = array(
                        "category" => $category,
                        "number" => $nb + 1,
                        "user_id" => $USER_ID,
                        "name" => $_POST["multi"],
                        "env" => $ENV
                    );
                
                    insert_request($values,$link,'questionnaires_names');

                    if($_GET["add"] != "") {
                        foreach($rows_user as $row_user) {
                            $row_user["number"] = $nb + 1;
                            insert_request($row_user,$link,'questionnaires');
                        }
                    }

                    unset($_POST);
                    unset($_GET["add"]);
                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                        || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
                    header($header.'Location: '.$protocol.$_SERVER['HTTP_HOST'].str_replace('add=','',$_SERVER['REQUEST_URI'])."&selected=".($nb+1));
                } elseif(in_array($_POST["multi"], $names)) {
                    $error = "Ce nom est déja utilisé ! Veuillez en choisir un autre.";
                } else {
                    $error = "Le nom doit contenir plus de 3 caractères.";
                }
            }
            ?>
            <div style="margin-top:15px;" id="add">
                <h3 ><?=$QUESTIONS[$category]["multi"]?> à ajouter:</h3>
                <form method="post" action="#">
                    <div style="display:flex; margin-top:10px;justify-content: space-between;">
                        <label for="multi" style="margin-right:10px">Nom de la parcelle</label>
                        <div style="width:60%; margin-right:10px" >
                            <input type="text" name="multi" value="<?php echo (isset($_POST["multi"]) ? $_POST["multi"] : '')?>"  maxlength="100"/>
                            <?=(isset($_GET["add"]) && $_GET["add"] != "")? 'Copie de '.$selected: ''; ?>
                        </div>
                        <input type="submit" value="Ajouter" style="width:180px;box-shadow: inset 0 0 0 2px #2ecc71;color:#2ecc71 !important;" class="button small fit"/>
                    </div>
                </form>
                <div style="display:flex; margin-top:10px;justify-content: space-between;">
                    <p style="color:red"><?=$error?></p>
                    <form method="get" action="#">
                        <input type="hidden" name="page" value="results"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Annuler" style="width:200px;box-shadow: inset 0 0 0 2px #e74c3c;color:#e74c3c !important;" class="button small fit"/>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <br/>
            
        <?php
    }
    ?>

    <div style="display:flex; margin-top:10px;justify-content: space-between;">

        <div>
            <h3>Enquètes à remplir:</h3>
            <ul>
                <?php 
                $CATEGORIES_TEXT = array();
                foreach($QUESTIONS as $cat => $cat_cf) {
                    if($_GET["category"] == $cat):
                        ?>

                            <?php 
                                foreach($cat_cf["values"] as $type => $cf) { 
                                    array_push($CATEGORIES_TEXT,"'".$cf['text']."'");
                                    ?>
                                    <li>
                                        <a href="<?=$cf['url']?>" style="text-transform: none !important;">
                                        <i class="icon fa-<?=$cf['icon']?>" style="color:<?=$cf['color']?>"></i>
                                        <?=$cf['text']?></a>
                                    </li>
                                <?php }
                            ?>

                        <?php
                    endif;
                }
                ?>
            </ul>
        </div>

        <div>
            <h3>Version:</h3>
            <?php 
                $i = 0;
                foreach($VERSIONS as $version) {
                    $VERSIONS[$i] = $version[0].' - '.$version[count($version) - 1];
                    $i++;
                }
            ?>

            <div style="display:flex;flex-direction:column;align-items:end;">
                <select onChange="changedVersion(this.value)" name="version-<?=$category?>" style="margin-right:10px">
                    <?php 
                    foreach($VERSIONS as $version => $dates):
                        ?>
                        <option value="<?=$version?>" <?php echo $current_version==$version ? "selected":""?>><?=$version?> - <?=$dates?></option>
                        <?php 
                    endforeach;
                    ?>
                </select>
                                
                <?php
                $complete = true;
                foreach($QUESTIONS[$category]["values"] as $type => $cf) { 
                    foreach($VERSIONS as $version => $dates):
                        $sql = "select count(*) as nb from questionnaires where category = '".$category."' and type = '".$type."' and user_id = ".$USER_ID." and answer != '' and number = ".get_selected_nb($category)." and version = ".$version." and `env` = '".$ENV."'";

                        $req = request($link,$sql,true);
                        $rows = $req->fetch_all(MYSQLI_ASSOC);
                        $nb = $rows[0]['nb'];
                
                        $values = $QUESTIONS[$category]["values"][$type]["values"];
                        $complete_v =  ''.$nb == ''.count($values);
                        if(!$complete_v) $complete = false;
                    endforeach;
                }

                if($complete):
                ?>
                    <br/>
                    <form method="post" action="#">
                        <input type="hidden" name="new_date" value="<?=$i?>"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Saisir une nouvelle version" style="width:250px;box-shadow: inset 0 0 0 2px #2ecc71;color:#2ecc71 !important;" class="button small fit"/>
                    </form>
                <?php endif; 
                
                if($current_version != 0):
                ?>

                    <br/>
                    <form method="post" action="#">
                        <input type="hidden" name="delete_date" value="<?=($i - 1)?>"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Supprimer la version" style="width:250px;box-shadow: inset 0 0 0 2px #e74c3c;color:#e74c3c !important;" class="button small fit"/>
                    </form>

                <?php
                endif;
                ?>

            </div>

        </div>
    </div>

    <h3>Résultats:</h3>

    <figure class="highcharts-figure">
        <p class="highcharts-description"><?=$QUESTIONS[$category]["description"]?></p>
        <div id="chart-container"></div> 
    </figure>

    <?php 
        $data = [];
        $dataA = [];
        $dataV = [];
        $dataVersions = array();
        
        foreach($VERSIONS as $version => $dates) {
            if ($version != $current_version) {
                $dataVersions[$version] = array();
            }
            foreach($QUESTIONS[$category]["values"] as $type => $cf) {
                if(array_key_exists($version, $scores_all)) {
                    $scores = $scores_all[$version][$type];

                    if ($version == $current_version) {
                        $type_title = $QUESTIONS[$category]["values"][$type]["text"];
                        $low = str_replace(',','.',''.$scores['low']);
                        $high = str_replace(',','.',''.$scores['high']);
                        if($low == '0') $low = 'null';
                        if($high == '0') $high = 'null';

                        $color = ($scores['low'] > $scores['high']) ? "#27ae60" : "#c0392b";

                        array_push($data, "{low:$low, high:$high,color:'$color'}");
                        array_push($dataV, "$low");
                        array_push($dataA, "$high");
                    } else {
                        $val = $scores['low'];
                        if($val == '0') $val = 'null';
                        array_push($dataVersions[$version], str_replace(',','.',''.$val));
                    }
                }
            }
        }
        $CATEGORIES_STRING = implode(",",$CATEGORIES_TEXT);
    ?>
    <script>
        var data = [<?=implode(",",$data)?>];
        var dataA = [<?=implode(",",$dataA)?>];
        var dataV = [<?=implode(",",$dataV)?>];
    </script>

    <?php

}
?>

<script>
    function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
    function(m,key,value) {
      vars[key] = value;
    });
    return vars;
  }

function toggleAdd() {
    var x = document.getElementById("add");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function changedMulti(value) {
    let params = "";
    let p = getUrlVars();
    for(var key in p) {
        if (key !== "selected") {
            params = params + key+"="+p[key]+"&";
        }
    }
    console.log("got to ","?" + params.replace('#','') + "selected=" +value)
    window.location = "?" + params.replace('#','') + "selected=" +value;
}


function changedVersion(value) {
    let params = "";
    let p = getUrlVars();
    for(var key in p) {
        if (key !== "selected_version") {
            params = params + key+"="+p[key].replace('#','')+"&";
        }
    }
    window.location = "?" + params + "selected_version=" +value;
    
}
</script>

<p style="text-align:justify"> <b><h4>Ce graphique indique les résultats de votre évaluation. </h4> </b>
</p><p style="text-align:justify">
<b>Le cercle </b> indique votre pourcentage quant à l’axe évalué :<b> plus son score est élevé, plus cet axe accroît l’exposition à la prédation</b>. <b>Le carré noir</b> correspond à la moyenne des autres éleveur.euse.s ayant utilisé le CERP. Cela vous permet donc de situer la vulnérabilité de votre exploitation par rapport aux autres éleveur.euse.s.  
</p><p style="text-align:justify">
Les pourcentages attribués à chacun des axes permettent d’identifier les principaux axes d’améliorations de votre exploitation face à la prédation.  
</p><p style="text-align:justify">
<h3><b>Explication du graphique </b>:</h3>  
</p><p style="text-align:justify">
Les explications qui vont suivre seront très générales. 
Si vous souhaitez comprendre précisément les différents facteurs appartenant à chacun des axes, veuillez cliquer sur l’onglet <b>« Les ressources »</b> puis <b>
    « Pourquoi ces facteurs ? »</b> dans la barre de gauche. La justification de ces facteurs vous permet de cerner les axes d’amélioration de votre exploitation.  
    </p><p style="text-align:justify">
<b>« Contexte économique » :</b> Cet axe correspond à l’influence de la forme de votre exploitation ainsi que sa situation économique sur l’exposition face à la prédation. Cet axe peut être à la fois une force (si le score est bas) ou une faiblesse (si le score est haut). Il apparait important d’avoir conscience de l’influence de ces facteurs sur la prédation. Il est par exemple plus facile d'équiper et d'être vigilant sur une exploitation avec un schéma en O (avec l'exploitation au milieu) que sur une exploitation en T ou L où l'exploitation ne donne pas sur tout le troupeau ou l’ensemble des parcelles. De même, les plus grands parcs sont plus difficiles à garder et présentent plus de risque d’oublier une bête quelque part. Un grand parc favorise la dispersion des animaux et accroît le risque de prédation. Par ailleurs, plus la situation financière de l’exploitation sera fragile, plus il sera compliqué pour vous de couvrir le montant investi dans les moyens de protection et à la charge de l’éleveur.euse.  
</p><p style="text-align:justify">
<b>« Contexte social » : </b>Cet axe permet de saisir des facteurs d’ordre <b>moral et psychologique</b>. 
    Souvent sous-considérés, ils peuvent avoir une influence importante sur la prédation. 
    Les situations de crises peuvent être générées ou renforcées par la prédation. 
    Les périodes de détresse psychologiques sont donc à prendre très au sérieux. Cela est d'autant plus vrai que dans un contexte de prédation, le phénomène d'isolement est renforcé et la vulnérabilité des personnes comme des exploitations est accentuée. L'intervention de professionnels, bénévoles ou proches bienveillants peut vous aider à résister aux crises. Pareillement, des difficultés vécues dans la vie personnelle perturbent l'équilibre avec la vie professionnelle. Cet équilibre lorsqu'il est rompu, favorise les situations de crise et réduisent les capacités à détecter, agir, etc. Si votre score est élevé concernant ce facteur, il semblerait que vous ayez peut-être besoin d’une aide ou d’un soutien moral. Pour cela, vous pouvez vous rendre dans l’onglet « Les ressources » puis « Ressources utiles » vous indiquant qui contacter en cas de besoin d’accompagnement moral et psychologique.  
    </p><p style="text-align:justify">
<b>« Elevage pasto » :</b> Ce domaine concerne vos pratiques pastorales (fréquence des visites de lot, nombres de lots, type de pâturage, type de naissance,
 points d’eau, etc.). Si votre score est élevé dans cette partie, c’est qu’il apparait important de vous questionner 
 sur vos méthodes pastorales afin de rendre votre élevage plus résilient face à la prédation. Par exemple, plus il y a de lots, 
 plus il est difficile de tout protéger. Cela accroît notamment la charge mentale et contribue à réduire la vigilance de l’éleveureur.euse.s 
 ou berger.ère.s. Cette caractéristique peut apparaitre difficile à faire changer sur un temps cours, car elle nécessite une réelle réorganisation. 
 Il est à noter qu’il existe des éléments plus simples et basiques à changer directement pour réduire la vulnérabilité en lien avec ce facteur. Par exemple, 
 vous pourriez déplacer vos points d’eau afin de les rendre davantage visibles et moins attirants pour des prédateurs, ou encore veiller à bien vérifier qu’il 
 n’y ait pas de carcasses/placentas ou autres déchets organiques sur votre parc.  
 </p><p style="text-align:justify">
<b>« Elevage animaux » : </b>Cet axe se concentre spécifiquement sur vos animaux d’élevage et leurs caractéristiques pouvant influencer le phénomène de prédation. Ainsi, si votre score est élevé dans ce domaine, cela signifie que vos animaux sont particulièrement vulnérables à la prédation par leurs caractéristiques propres. Tout d’abord, les sensibilités entre les espèces peuvent réduire ou accroître le risque de prédation. Globalement, les petits ruminants sont les plus exposés à la prédation ce qui n'écarte par la vulnérabilité d'autres types d'élevage (bovin, équin, etc.). Pareillement, des bêtes farouches et éparpillées dans une parcelle s'exposent plus à la prédation. Les troupeaux grégaires ayant le réflexe de se regrouper en cas de perturbation sont plus faciles à protéger et plus difficiles à attaquer pour un prédateur. Par ailleurs, la relation entre vous-même et vos animaux peut s’avérer décisive pour faire face à la prédation. Une relation dégradée entre un.e éleveur.euse ou un.e berger.ère et ses animaux favorise des comportements et situations inhabituelles et délétères. Une relation saine encourage le retour au calme du troupeau après un évènement inhabituel/stressant. La détérioration brutale de l'attitude du troupeau à l'égard de son/sa gardien.ne est un indicateur de perturbation à prendre en compte, notamment dans un contexte de prédation. Ainsi, bien connaitre vos animaux et travailler dans un climat de confiance avec ces derniers peut contribuer à réduire le risque de prédation sur votre troupeau. 
</p><p style="text-align:justify">
<b>« Protection structurelle » :</b> Cet axe concerne principalement l’influence de vos clôtures sur la prédation. Les clôtures, comme le type de parc, ont une influence sur l'accès des prédateurs au troupeau. Plus la clôture est difficile à passer, plus le risque de traverser la clôture diminue. Ainsi, une clôture haute et électrifiée réduit l'exposition à la prédation alors que l'absence de clôture ou des clôtures très basses l'augmente et renforce le comportement du prédateur. Ce même, l'état des clôtures du parc est déterminant quant à son efficacité. Pour connaitre les formats de clôtures les plus efficaces contre la prédation lupine, vous pouvez vous rendre sur la barre à gauche dans l’onglet « Les ressources » puis « Ressources utiles » pour enfin cliquer sur « Clôtures de protection contre le loup » 
</p><p style="text-align:justify">
<b>« Protection vivante » :</b> Cet axe concerne l’influence de votre type de gardiennage (humain et non humain) sur votre troupeau. L’absence totale de gardiennage sur votre troupeau augmente considérablement la vulnérabilité de votre exploitation face à la prédation. L’un des meilleurs moyens de protection face à la prédation reste le chien de protection. Si vous ne connaissez pas ce mode de protection, il existe une fiche explicative sur les chiens, vous pouvez vous rendre dans la barre à gauche dans l’onglet « Les ressources » puis « Ressources utiles » pour enfin cliquer sur « Chiens de travail en agriculture ». Vous pouvez également contacter l’Association de Vulgarisation et Initiatives en Ethologie (VIE), partenaire du projet disponible pour répondre à vos questions : Camille Fraissard - Co-présidente et éthologue / associationdevie@gmail.com ou l’institut de l’élevage en région https://idele.fr/fileadmin/medias/Documents/Carte_referents_chiens_de_protection_2021.pdf.  
</p><p style="text-align:justify">
<b>« Environnement milieu » : </b>Cet axe concerne l’environnement physique de votre exploitation. Si vous avez un score élevé sur cet axe, c’est que l’une des principales failles de l’exploitation est l’environnement de votre exploitation. Par exemple, un cours d'eau proche de l’exploitation apparait difficile à clôturer. Les bandes enherbées attenantes aux petits cours d'eau sont des couloirs de circulation et potentiellement un garde-manger lorsqu'elles sont pâturées. Les cours d'eau à sec en été sont des corridors privilégiés alors même que les grands cours d'eau sont peu voir infranchissables et réduisent l'exposition du troupeau à la prédation. Afin de réduire cette vulnérabilité, il faudrait par exemple éviter de mettre le troupeau (surtout suité) dans la parcelle proche du cours d’eau. Un autre exemple comme peut se traduire à travers la présence d’objet remarquables dans le pâturage (objets imposants, rochers, tas de bois, etc.) et niveau d’embroussaillement. Les prédateurs peuvent les utiliser pour se dissimuler. Plus le nombre d'objets remarquables augmente, plus le risque d'exposition augmente. Ainsi, enlever les potentiels objets remarquables comme des tas de bois peut réduire la vulnérabilité du troupeau.  
</p><p style="text-align:justify">
<b>« Environnement biologie » : </b>Cet axe se centre sur le prédateur en lui-même. Par exemple, certaines périodes sont plus propices à la prédation (juin à septembre). Ainsi, si votre troupeau pâture pendant cette période sur une parcelle non protégée, les risques de prédation augmentent plus que sur une autre période. Par ailleurs, les cercles prévus dans le cadre du PNA Loup et activités d’élevage sont liés à la fréquence des évènements de prédation. Ce classement donne une information reconnue quant au risque de prédation sur une exploitation. Cependant, être dans le Cercle 0 ne signifie pas s'exposer à une attaque imminente, et ne pas être dans l'un des cercles ne signifie pas qu'un évènement de prédation lié au loup est à exclure. 
</p><p style="text-align:justify">