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
                header('Location: '.$protocol.$_SERVER['HTTP_HOST'].str_replace('selected=','',str_replace('delete=','',$_SERVER['REQUEST_URI'])).'&selected=1');
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
                    header('Location: '.$protocol.$_SERVER['HTTP_HOST'].str_replace('add=','',$_SERVER['REQUEST_URI'])."&selected=".($nb+1));
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