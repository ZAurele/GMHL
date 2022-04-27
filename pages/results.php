<?php 

if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT distinct `version`, `update_date` FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' and env = '".$ENV."' order by `update_date`";
    $rows = select_request($link,$sql,true);
    
    $versions = array();
    foreach($rows as $row) {
        if(!array_key_exists($row["version"], $versions)) {
            $versions[$row["version"]] = array();
        }
        if(!in_array($row["update_date"], $versions[$row["version"]])) {
            array_push($versions[$row["version"]], $row["update_date"]);
        }
    }
    $current_version = $SELECTED_VERSION[$category];
    if (!in_array($current_version, $versions)) {
        $versions[$current_version] = array(date("Y-m-d H:i:s"));
    }
    
    $sql = "SELECT * FROM questionnaires where user_id != ".$USER_ID." and category = '".$category."' and env = '".$ENV."' order by id DESC";
    $rows = select_request($link,$sql,true);

    $scores = get_scores_from_database($QUESTIONS, $category, $rows);  

    $scores_all = array();
    
    foreach($versions as $version => $dates) {
        $scores_all[$version] = array();
        foreach($QUESTIONS[$category]["values"] as $type => $cf) {
            $scores_all[$version][$type] = array("low"=>0, "high"=>0, "name" =>$type);
        }

        $sql = "SELECT * FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' and number = '".$SELECTED_NB[$category]."' and version = ".$version." and env = '".$ENV."' order by id DESC";
        $rows = select_request($link,$sql,true);

        $scores_user = get_scores_from_database($QUESTIONS, $category, $rows);

        foreach($scores as $type => $scores_ids) {
            $score = array_sum(array_values($scores_ids));
            $scores_all[$version][$type]["high"] = round(($score / $SCORES_MAX[$category][$type])*100);
        }
        foreach($scores_user as $type => $scores_ids) {
            $score = array_sum(array_values($scores_ids));
            $scores_all[$version][$type]["low"] = round(($score / $SCORES_MAX[$category][$type])*100);
        }
    }

    $error = '';

    if (isset($QUESTIONS[$category]["multi"])) {
        $sql = "SELECT * FROM questionnaires_names where user_id = ".$USER_ID." and category = '".$category."' order by number DESC";
        $rows = select_request($link,$sql,true);

        ?>
            <?php if(!isset($_GET["add"])):?>
                <h3><?=$QUESTIONS[$category]["multi"]?>:</h3>
                <div style="display:flex;">
                    <select onChange="changedMulti(this.value)" name="choice-<?=$category?>" style="margin-right:10px">
                        <option value="1" <?php echo $SELECTED_NB[$category]=="1" ? "selected":""?>><?=$QUESTIONS[$category]["multi"]?> principale</option>

                        <?php foreach($rows as $row):
                            ?>
                            <option value="<?=$row["number"]?>" <?php echo $SELECTED_NB[$category]==$row["number"] ? "selected":""?>><?=$QUESTIONS[$category]["multi"]?> <?=$row["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                    <form method="get" action="#">
                        <input type="hidden" name="add" value=""/>
                        <input type="hidden" name="page" value="results"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Ajouter une parcelle" style="width:200px" class="button small fit"/>
                    </form>
                </div>
            
            <?php else:
                if(isset($_POST["multi"])) {
                    $names = array_map(fn($value): string => $value["name"], $rows);
                    $numbers = array_map(fn($value): int => $value["number"], $rows);
                    $nb = count($numbers) != 0 ? max($numbers) : 1;
        
                    if(!in_array($_POST["multi"], $names) && strlen($_POST["multi"]) > 3) {
                        $values = array(
                            "category" => $category,
                            "number" => $nb + 1,
                            "user_id" => $USER_ID,
                            "name" => $_POST["multi"]
                        );
                    
                        insert_request($values,$link,'questionnaires_names');
                        unset($_POST);
                        unset($_GET["add"]);
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
                            <input type="text" name="multi" value="<?php echo (isset($_POST["multi"]) ? $_POST["multi"] : '')?>" style="width:60%; margin-right:10px"  maxlength="100"/>
                            <input type="submit" value="Ajouter" style="width:180px" class="button small fit"/>
                        </div>
                    </form>
                    <div style="display:flex; margin-top:10px;justify-content: space-between;">
                        <p style="color:red"><?=$error?></p>
                        <form method="get" action="#">
                            <input type="hidden" name="page" value="results"/>
                            <input type="hidden" name="category" value="<?=$category?>"/>
                            <input type="submit" value="Annuler" style="width:200px" class="button small fit"/>
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
                foreach($versions as $version) {
                    $versions[$i] = $version[0].' - '.$version[count($version) - 1];
                    $i++;
                }
            ?>

            <div style="display:flex;flex-direction:column;align-items:end;">
                <select onChange="changedVersion(this.value)" name="version-<?=$category?>" style="margin-right:10px">
                    <?php 
                    foreach($versions as $version => $dates):
                        ?>
                        <option value="<?=$version?>" <?php echo $current_version==$version ? "selected":""?>><?=$version?> - <?=$dates?></option>
                        <?php 
                    endforeach;
                    ?>
                </select>
                                
                <?php if($QUESTIONS[$category]["complete"]):?>
                    <br/>
                    <form method="post" action="#">
                        <input type="hidden" name="new_date" value="<?=$version_i?>"/>
                        <input type="hidden" name="category" value="<?=$category?>"/>
                        <input type="submit" value="Saisir une nouvelle version" style="width:250px" class="button small fit"/>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>

    <h3>Résultats:</h3>
    <figure class="highcharts-figure">
        <div id="chart-container"></div>
        <p class="highcharts-description"><?=$QUESTIONS[$category]["description"]?></p>
    </figure>

    <?php 
        $data = [];
        $dataA = [];
        $dataV = [];
        $dataVersions = array();
        
        foreach($versions as $version => $dates) {
            if ($version != $current_version) {
                $dataVersions[$version] = array();
            }
            foreach($QUESTIONS[$category]["values"] as $type => $cf) {
                $scores = $scores_all[$version][$type];

                if ($version == $current_version) {
                    $type_title = $QUESTIONS[$category]["values"][$type]["text"];
                    $low = str_replace(',','.',''.$scores['low']);
                    $high = str_replace(',','.',''.$scores['high']);
                    $color = ($scores['low'] > $scores['high']) ? "#27ae60" : "#c0392b";
                    array_push($data, "{low:$low, high:$high,color:'$color'}");
                    array_push($dataV, "$low");
                    array_push($dataA, "$high");
                } else {
                    array_push($dataVersions[$version], str_replace(',','.',''.$scores['low']));
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
    window.location = "?" + params + "selected=" +value;
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