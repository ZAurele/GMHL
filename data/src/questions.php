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
			"Prevention_Structurelle_WALLON"=> array("text" => "Prévention structurelle général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
			"Prevention_Vivante_WALLON"=> array("text" => "Prévention vivante général", "icon" => "", "complete" => false, "color" => "", "url" => "",  "values" => array()),
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

$ENV = isset($PROFILS["country"]) ? $PROFILS["country"] : "fr";
$QUESTIONS = $QUESTIONS_GROUPS[$ENV];

$CATEGORIES = array();
$SELECTED_NB = array();
$SELECTED_VERSION = array();

foreach($QUESTIONS as $category => $cat_cf) {
    array_push($CATEGORIES, $category);
    $SELECTED_NB[$category] = "1";
    $SELECTED_VERSION[$category] = 0;

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
            if($qu[0] != "") 
            $values[$qu[0]] = array("id"=>$qu[0], "title"=> capitalize($qu[1]), "values"=>$answers);
        }
		$QUESTIONS[$category]["values"][$type]["values"] = $values;
	}
}

if(isset($_GET["selected"]) && isset($_GET["category"])) {
    $_SESSION[$_GET["category"]."multi"] = $_GET["selected"];
    $SELECTED_NB[$_GET["category"]] = $_GET["selected"];
}

if(isset($_GET["selected_version"]) && isset($_GET["category"])) {
    $_SESSION[$_GET["category"]."version"] = $_GET["selected_version"];
    $SELECTED_VERSION[$_GET["category"]] = $_GET["selected_version"];
}

if(isset($_POST["new_date"]) && isset($_POST["category"])) {
    $_SESSION[$_POST["category"]."version"] = $_POST["new_date"];
    $SELECTED_VERSION[$_POST["category"]] = $_POST["new_date"];
}

foreach ($CATEGORIES as $cat) {
    if(isset($_SESSION[$cat."multi"])){
        $SELECTED_NB[$cat] = $_SESSION[$cat."multi"];
    }
    if(isset($_SESSION[$cat."version"])){
        $SELECTED_VERSION[$cat] = $_SESSION[$cat."version"];
    }
}

$SCORES_MAX = array();

foreach($QUESTIONS as $category => $cf_cat) {
    $bareme = $QUESTIONS[$category]["bareme"];
    $first_invalid_type = null;
    $first_type = null;

    foreach($cf_cat["values"] as $type => $cf) {
        if ($first_type == null) $first_type = $type;

        foreach ($cf["values"] as $id => $v) {
            if (isset($bareme[$id])) {
                $bareme_question = $bareme[$id];

                if (!isset($SCORES_MAX[$category]))
                    $SCORES_MAX[$category] = array();
                if (!isset($SCORES_MAX[$category][$type]))
                    $SCORES_MAX[$category][$type] = 0;
                if (!isset($SCORES_MAX[$category][$type][$id])) {
                    try {
                        $SCORES_MAX[$category][$type] += intval($bareme_question["score_max"]);
                    } catch(Exception $e) {echo '';}
                }
            }
        }

        $sql = "select count(*) as nb from questionnaires where category = '".$category."' and type = '".$type."' and user_id = ".$USER_ID." and answer != '' and number = ".$SELECTED_NB[$category]." and version = ".$SELECTED_VERSION[$category]." and env = '".$ENV."'";

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

function get_scores_from_database($QUESTIONS, $category, $rows,$max=false) {
    $types = $QUESTIONS[$category]["values"];
    $bareme = $QUESTIONS[$category]["bareme"];

    $scores = array();

    foreach ($rows as $row) {
        $type = $row["type"];
        $id = $row["id"];

        $entries = $types[$type]["values"];
        $v = $entries[$id];
        if (!isset($v["values"][$row["answer"]])) continue;
        $answer_text = $v["values"][$row["answer"]];

        if(!isset($scores[$type])) $scores[$type] = array();
        if(!isset($scores[$type][$id])) $scores[$type][$id] = array();
        if(isset($bareme[$id])) {
            $bareme_question = $bareme[$id];

            if ($max) {
                $bareme_values = array();
                foreach ($bareme_question["values"] as $key => $value) {
                    if($value != "NA") $bareme_values[$key] = $value;
                }
                $answer_text = array_key_max_value($bareme_values);
            }

            //if($debug)echo "<br>$id : $answer_text<br>";
            if (isset($bareme_question["values"][$answer_text])) {
                //if($debug) var_dump($bareme_question["values"]);
                $score = $bareme_question["values"][$answer_text];
                array_push($scores[$type][$id],$score);
                //if($debug)echo "<br>$id $score<br>";
            } else if ($answer_text != "NA") {
                debug("Missing answer $answer_text in bareme for category $category, type $type and question $id");
            }
        }
    }  

    //if ($debug) var_dump($scores);

    foreach($scores as $type => $qs) {
        foreach($qs as $id => $values) {
            if (count($values) != 0)
                $scores[$type][$id] = array_sum($values) / count($values);
            else 
                $scores[$type][$id] = 0;
        }
    }
    return $scores;  
}

function get_bareme($path) {
    $bareme_raw = readCsv($path);
    $bareme = array();
    foreach($bareme_raw as $row) {
        if (!isset($bareme[$row[0]])) {
            $bareme[$row[0]] = array("values"=> array(),"score_max"=>$row[3]);
        }
        if ($row[0] != '')
        $bareme[$row[0]]["values"][$row[1]] = $row[2];
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