
<?php 
$QUESTIONS_GROUPS = array("fr" => array(
	"enquete_social" => array(
		"text" => "Enquête sociale",
        "description" => "",
        "bareme" => get_bareme("Bareme_Parcelle"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#8e44ad",
        "complete" => false,
        "disabled" => true,
		"values" => 
		array(
			
		)
        ),
    "evaluation_generale" => array(
		"text"=> "Évaluation générale",
        "description" => "",
        "bareme" => get_bareme("Bareme_General"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#f39c12",
        "complete" => false,
		"values" =>
		array(
			"Contexte_Economique_General" => array("text" => "Contexte économique general", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Contexte_Social_General"=> array("text" => "Contexte social général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Elevage_Pasto_General"=> array("text" => "Élevage pasto general", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Elevage_Animaux_General"=> array("text" => "Élevage animaux general", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Protection_Structurelle_General"=> array("text" => "Protection structurelle général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Protection_Vivante_General"=> array("text" => "Protection vivante général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_Milieu_General"=> array("text" => "Environnement milieu général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_Biologie_General"=> array("text" => "Environnement biologie général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array())
		)
	),
	"evaluation_parcelle" => array(
		"text" => "Évalution parcelle",
        "description" => "",
        "bareme" => get_bareme("Bareme_Parcelle"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#27ae60",
        "complete" => false,
        "multi" => "Parcelle",
		"values" => 
		array(
			"Contexte_Socioeco_Parcelle" => array("text" => "Contexte socioéco parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Elevage_Parcelle" => array("text" => "Élevage parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Protection_Parcelle" => array("text" => "Protection parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_Parcelle" => array("text" => "Environnement parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
		)
	)
),
"be" => 
array(
	"enquete_social" => array(
		"text" => "Enquête sociale",
        "description" => "",
        "bareme" => get_bareme("Bareme_Parcelle"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#8e44ad",
        "complete" => false,
        "disabled" => true,
		"values" => 
		array(
			
		)
        ),
    "evaluation_generale" => array(
		"text"=> "Évaluation générale",
        "description" => "",
        "bareme" => get_bareme("Bareme_General_WALLON"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#f39c12",
        "complete" => false,
		"values" =>
		array(
			"Elevage_WALLON"=> array("text" => "Élevage", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Prevention_structurelle_WALLON"=> array("text" => "Prévention structurelle général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Prevention_vivante_WALLON"=> array("text" => "Prévention vivante général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_WALLON"=> array("text" => "Environnement", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_General_WALLON"=> array("text" => "Environnement général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array())
		)
	),
	"evaluation_parcelle" => array(
		"text" => "Évalution parcelle",
        "description" => "",
        "bareme" => get_bareme("Bareme_Parcelle"),
        "icon" => "",
        "url" => "",
        "color" => "",
        "b-color" => "#27ae60",
        "complete" => false,
        "multi" => "Parcelle",
		"values" => 
		array(
			"Contexte_Socioeco_Parcelle" => array("text" => "Contexte socioéco parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Elevage_Parcelle" => array("text" => "Élevage parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Protection_Parcelle" => array("text" => "Protection parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Environnement_Parcelle" => array("text" => "Environnement parcelle", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
		)
	)
)
        );

// ENV
$ENV = isset($PROFILS["country"]) ? $PROFILS["country"] : "fr";

// INIT
$QUESTIONS = $QUESTIONS_GROUPS[$ENV];

$CATEGORIES = array();
$SELECTED_NB = array();
$SELECTED_VERSION = array();

function get_key_nb($category) {
    global $ENV;
    return $category.$ENV;
}

function set_selected_nb($category, $nb) {
    global $SELECTED_NB;

    $_SESSION[get_key_nb($category)."multi"] = ''.$nb;
    $SELECTED_NB[get_key_nb($category)] = ''.$nb;
    //debug("NB: set selected ".get_key_nb($category)." - ".$nb);
}

function get_selected_nb($category) {
    global $SELECTED_NB;
    //debug("NB: get selected ".get_key_nb($category)." - ".$SELECTED_NB[get_key_nb($category)]);
    if (!array_key_exists(get_key_nb($category), $SELECTED_NB)) return null;
    return $SELECTED_NB[get_key_nb($category)];
}

function get_key_version($category) {
    global $ENV;
    return $category.$ENV.get_selected_nb($category);
}

function set_selected_version($category, $version) {
    global $SELECTED_VERSION;
    $_SESSION[get_key_version($category)."version"] = $version;
    $SELECTED_VERSION[get_key_version($category)] = $version;
    //debug("VERSION: set selected ".get_key_version($category)." - ".$version);
}

function get_selected_version($category) {
    global $SELECTED_VERSION;
    //debug("VERSION: get selected ".get_key_version($category)." - ".$SELECTED_VERSION[get_key_version($category)]);
    if (!array_key_exists(get_key_version($category), $SELECTED_VERSION)) return null;
    return $SELECTED_VERSION[get_key_version($category)];
}

// SELECTED CURRENT
if(isset($_GET["selected"]) && isset($_GET["category"])) 
    set_selected_nb($_GET["category"], $_GET["selected"]);

// SET SESSION
foreach($QUESTIONS as $category => $cat_cf) array_push($CATEGORIES, $category);

foreach ($CATEGORIES as $cat) {
    $nb_key = get_key_nb($cat)."multi";
    $session_key = get_key_version($cat)."version";

    if(isset($_SESSION[$nb_key])) {
        if (get_selected_nb($category) == null) {
            set_selected_nb($cat, $_SESSION[$nb_key]);
        }
    }
    if(isset($_SESSION[$session_key])) {
        if (get_selected_version($category) == null) {
            debug($category." get version from session");
            set_selected_version($cat, $_SESSION[$session_key]);
        }
    }
}

foreach($QUESTIONS as $category => $cat_cf) {
    if (get_selected_nb($category) == null) {
        debug($category.'set with init');
        set_selected_nb($category, 1);
    }

	foreach ($cat_cf["values"] as $type => $cf) {
		$path = $category."/".$type;
		$raw_values = readCsv($path);

        $values = array();
        foreach($raw_values as $qu) {
            $raw_answers = array_slice($qu,2);
            $answers = array();
            foreach($raw_answers as $k=>$v) {
                if($v != "NA" && $v != '') $answers[$k] = $v;
            }
            $id = strtolower($qu[0]);

            if($id != "") 
            $values[$id] = array("id"=>$id, "title"=> capitalize($qu[1]), "values"=>$answers);
        }
		$QUESTIONS[$category]["values"][$type]["values"] = $values;
	}
}

// DELETE VERSION
if(isset($_POST["delete_date"]) && isset($_POST["category"])) {
    $sql = "DELETE FROM `questionnaires_names` WHERE `version` = ".$_POST["delete_date"]." and `number` = '".get_selected_nb($_POST["category"])."' and `category` = '".$_POST["category"]."'";		
    $req = mysqli_query($link,$sql);

    $sql = "DELETE FROM `questionnaires` WHERE `version` = ".$_POST["delete_date"]." and `number` = '".get_selected_nb($_POST["category"])."' and `category` = '".$_POST["category"]."'";		
    $req = mysqli_query($link,$sql);
}

// VERSIONS
$VERSIONS = array();
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $sql = "SELECT distinct `version`, `update_date` FROM questionnaires where user_id = ".$USER_ID." and category = '".$category."' and `env` = '".$ENV."' order by `update_date`";
    $rows = select_request($link,$sql,true);
    
    foreach($rows as $row) {
        if(!array_key_exists($row["version"], $VERSIONS)) {
            $VERSIONS[$row["version"]] = array();
        }
        if(!in_array($row["update_date"], $VERSIONS[$row["version"]])) {
            array_push($VERSIONS[$row["version"]], $row["update_date"]);
        }
    }

    $sql = "SELECT distinct `version`, `update_date` FROM questionnaires_names where user_id = ".$USER_ID." and category = '".$category."' and `env` = '".$ENV."' order by `update_date`";
    $rows = select_request($link,$sql,true);

    foreach($rows as $row) {
        if(!array_key_exists($row["version"], $VERSIONS)) {
            $VERSIONS[$row["version"]] = array();
        }
        if(!in_array($row["update_date"], $VERSIONS[$row["version"]])) {
            array_push($VERSIONS[$row["version"]], $row["update_date"]);
        }
    }

    if (count(array_keys($VERSIONS)) !=  0 and !array_key_exists(get_selected_version($_GET['category']), $VERSIONS)) {
        set_selected_version($_GET['category'], max(array_keys($VERSIONS)));
    }
}

// NEW VERSION
if(isset($_POST["new_date"]) && isset($_POST["category"])) {
    set_selected_version($_POST["category"], $_POST["new_date"]);
    $new_version = max(array_keys($VERSIONS)) + 1;

    $sql = "SELECT `name` FROM questionnaires_names where `number` = '".get_selected_nb($category)."' and `env` = '".$ENV."' and user_id = ".$USER_ID." and category = '".$category."' order by number DESC";
    $rows = select_request($link,$sql,true);

    $values = array(
        "category" => $_POST["category"],
        "number" => get_selected_nb($_POST["category"]),
        "user_id" => $USER_ID,
        "env" => $ENV,
        "version" => $new_version,
        "name" => count($rows) == 0 ? "" : $rows[0]["name"]
    );

    insert_request($values,$link,'questionnaires_names');

    $VERSIONS[$new_version] = array(date('Y-m-d G:i:s'));
}

// SELECTED ALL

if(isset($_GET["selected_version"]) && isset($_GET["category"])) {
    if (array_key_exists($_GET["selected_version"],$VERSIONS)) {
        set_selected_version($_GET["category"], $_GET["selected_version"]);
    }
}

foreach($QUESTIONS as $category => $cat_cf) {
    if (get_selected_version($category) == null) {
        set_selected_version($category, 0);
    }
}

if (isset($_GET['category'])) {
    $current_version = get_selected_version($_GET['category']);
    if (!in_array($current_version, $VERSIONS)) {
        $VERSIONS[$current_version] = array(date("Y-m-d H:i:s"));
    }
}

$SCORES_MAX = array();

foreach($QUESTIONS as $category => $cf_cat) {
    if (!isset($SCORES_MAX[$category]))
        $SCORES_MAX[$category] = array();

    $bareme = $QUESTIONS[$category]["bareme"];

    $first_invalid_type = null;
    $first_type = null;

    foreach($cf_cat["values"] as $type => $cf) {
        if (!isset($SCORES_MAX[$category][$type]))
            $SCORES_MAX[$category][$type] = array();

        if ($first_type == null) $first_type = $type;

        foreach ($cf["values"] as $id => $v) {
            $id = strtolower($id);

            if (isset($bareme[$id])) {
                $bareme_question = $bareme[$id];

                if (!isset($SCORES_MAX[$category][$type][$id])) {
                    try {
                        $SCORES_MAX[$category][$type][$id] = intval($bareme_question["score_max"]);
                    } catch(Exception $e) {echo '';}
                }
            } else {
                debug("Missing id ".$id." in bareme for category ".$category." and type ".$type);
            }
        }

        $sql = "select count(*) as nb from questionnaires where category = '".$category."' and type = '".$type."' and user_id = ".$USER_ID." and answer != '' and number = ".get_selected_nb($category)." and version = ".get_selected_version($category)." and `env` = '".$ENV."'";

        $req = request($link,$sql,true);
        $rows = $req->fetch_all(MYSQLI_ASSOC);
        $nb = $rows[0]['nb'];

        $values = $QUESTIONS[$category]["values"][$type]["values"];
        $complete =  ''.$nb == ''.count($values);

        if (!$first_invalid_type && $first_invalid_type == null && !$complete)
            $first_invalid_type  = $type;

        $QUESTIONS[$category]["values"][$type]['icon'] = $complete ? 'check-square-o' : 'square-o';
        $QUESTIONS[$category]["values"][$type]['complete'] = $complete;
        $QUESTIONS[$category]["values"][$type]['color'] = $complete ? '#27ae60' : '#d35400';
        $QUESTIONS[$category]["values"][$type]['url'] = '?page=questions&amp;category='.$category.'&amp;type='.$type;
    }

    $complete = $first_invalid_type == null;
    
    $QUESTIONS[$category]['icon'] = $complete ? 'check-square-o' : 'square-o';
    $QUESTIONS[$category]['complete'] = $complete;
    $QUESTIONS[$category]['color'] = $complete ? '#27ae60' : '#d35400';

    $type = $complete ? $first_type: $first_invalid_type;
    $QUESTIONS[$category]['url'] = '?page=questions&amp;category='.$category.'&amp;type='.$type;
}

function get_scores_from_database($QUESTIONS, $category, $rows,$debug=false) {
    $types = $QUESTIONS[$category]["values"];
    $bareme = $QUESTIONS[$category]["bareme"];

    $scores = array();

    foreach ($rows as $row) {
        $type = $row["type"];
        $id = $row["id"];
        $id = strtolower($id);

        $entries = $types[$type]["values"];

        $v = $entries[$id];
        $answer = $row["answer"] - 1;

        if (!isset($v["values"][$answer])) continue;

        $answer_text = trim($v["values"][$answer]);

        if(!isset($scores[$type])) $scores[$type] = array();
        if(!isset($scores[$type][$id])) $scores[$type][$id] = 'NA';
        if(isset($bareme[$id])) {
            $bareme_question = $bareme[$id];

            /*if ($max) {
                $bareme_values = array();
                foreach ($bareme_question["values"] as $key => $value) {
                    if($value != "NA") $bareme_values[$key] = $value;
                }
                $answer_text = array_key_max_value($bareme_values);
            }*/

            /*if($debug) echo "<br>$id ".$row['answer'].": $answer_text<br>";
            if($debug) var_dump($bareme_question["values"]);*/

            if (isset($bareme_question["values"][$answer_text])) {
                
                $score = $bareme_question["values"][$answer_text];
                if (trim(''.$score) != '') {
                    $scores[$type][$id] = intval($score);
                } else {
                    $error_txt = "Empty answer ($answer_text) in bareme for category $category, type $type and question $id";
                    if ($debug) echo '</br>'.$error_txt.'</br>';
                    debug($error_txt);
                }
                //if($debug)echo "<br>$id $score<br>";
            } else if ($answer_text != "NA") {
                $error_txt = "Missing answer ($answer_text) in bareme for category $category, type $type and question $id";
                if ($debug) echo '</br>'.$error_txt.'</br>';
                debug($error_txt);
            }
        }
    }  

    if ($debug) var_dump($scores);
    return $scores;  
}

function get_bareme($path) {
    $bareme_raw = readCsv($path);
    $bareme = array();
    foreach($bareme_raw as $row) {
        if (!isset($bareme[strtolower($row[0])])) {
            $bareme[strtolower($row[0])] = array("values"=> array(),"score_max"=>$row[3]);
        }
        if ($row[0] != '')
        $bareme[strtolower($row[0])]["values"][trim($row[1])] = $row[2];
    }

    return $bareme;
}

function update_answer($link, $category, $type, $key, $value, $user_id, $number, $version, $env) {
    $sql_insert = "insert into questionnaires (category, type, id, answer, user_id, number, version, env)" ;
    $sql_insert .= " values ('$category', '$type', '".$key."', ".$value.", ".$user_id.", ".$number.", ".$version.",'".$env."')";
    $sql_insert .= " on duplicate key update answer = ".$value;

    return request($link,$sql_insert, false);
}

?>

