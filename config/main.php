<?php 
session_start(); 

ini_set('error_reporting', -1);

ini_set('display_errors', 1);

// Config

header( "Content-Type: text/html; charset=utf8" );
setlocale (LC_ALL, 'fr_FR.utf8');
//date_default_timezone_set('Europe/Paris');
mb_internal_encoding("UTF-8");

//setlocale(LC_TIME,"fr_FR");
if( ! ini_get('date.timezone') ){
    date_default_timezone_set('Europe/Paris');
}
//include '../cro/config/dates.php';

// Utils
include "utils/constants.php";

// SRC
include "src/functions.php";
include "src/database.php";
include "src/arrays.php";

include "data/src/functions.php";

$link = new mysqli($host,$user,$passwd,$db);

if (mysqli_connect_error()) {    
    die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

include "config/users.php";

// PAGES
$currentPage = "login.php";
if($logged){    
    if(isset($_GET['page'])){        
        $currentPage = $_GET['page'].".php";    
    } else {        
        $currentPage = "main.php";    
    }
}
include "data/mail/mail.php";
include "data/constructs.php";
include "data/posts.php";
include "data/get.php";
include "data/sql.php";
include "data/profil.php";
include "init.php";

include 'data/excels/read.php';

$QUESTIONS = array(
	"evaluation_generale" => array(
		"text"=> "Évaluation générale",
        "bareme" => get_bareme("Bareme_General"),
		"values" =>
		array(
			"Contexte_Economique_General" => array("text" => "Contexte économique general", "icon" => "",  "values" => array()),
			"Contexte_Social_General"=> array("text" => "Contexte social général", "icon" => "",  "values" => array()),
			"Elevage_Pasto_General"=> array("text" => "Élevage pasto general", "icon" => "",  "values" => array()),
			"Elevage_Animaux_General"=> array("text" => "Élevage animaux general", "icon" => "",  "values" => array()),
			"Protection_Structurelle_General"=> array("text" => "Protection structurelle général", "icon" => "",  "values" => array()),
			"Protection_Vivante_General"=> array("text" => "Protection vivante général", "icon" => "",  "values" => array()),
			"Environnement_Milieu_General"=> array("text" => "Environnement milieu général", "icon" => "",  "values" => array()),
			"Environnement_Biologie_General"=> array("text" => "Environnement biologie général", "icon" => "",  "values" => array())
		)
	),
	"evaluation_parcelle" => array(
		"text" => "Évalution parcelle",
        "bareme" => get_bareme("Bareme_Parcelle"),
		"values" => 
		array(
			"Contexte_Socioeco_Parcelle" => array("text" => "Contexte socioéco parcelle", "icon" => "",  "values" => array()),
			"Elevage_Parcelle" => array("text" => "Élevage parcelle", "icon" => "",  "values" => array()),
			"Protection_Parcelle" => array("text" => "Protection parcelle", "icon" => "",  "values" => array()),
			"Environnement_Parcelle" => array("text" => "Environnement parcelle", "icon" => "",  "values" => array()),
		)
	)
);

foreach($QUESTIONS as $category => $cat_cf) {
	foreach ($cat_cf["values"] as $type => $cf) {
		$path = $category."/".$type;
		$raw_values = readCsv($path);

        $values = array();
        foreach($raw_values as $qu) {
            $answers = array_slice($qu,2);

            $values[$qu[0]] = array("id"=>$qu[0], "title"=> capitalize($qu[1]), "values"=>$answers);
        }
		$QUESTIONS[$category]["values"][$type]["values"] = $values;
	}
}

function get_bareme($path) {
    $bareme_raw = readCsv($path);
    $bareme = array();
    foreach($bareme_raw as $row) {
        if (!isset($bareme[$row[0]])) {
            $bareme[$row[0]] = array("values"=> array(),"score_max"=>$row[3]);
        }
        $bareme[$row[0]]["values"][$row[1]] = $row[2];
    }
    return $bareme;
}

$SCORES_MAX = array();
foreach($QUESTIONS as $category => $cf_cat) {
    $bareme = $QUESTIONS[$category]["bareme"];

    foreach($cf_cat["values"] as $type => $cf) {
        foreach ($cf["values"] as $id => $v) {
            $bareme_question = $bareme[$id];

            if (!isset($SCORES_MAX[$category]))
                $SCORES_MAX[$category] = array();
            if (!isset($SCORES_MAX[$category][$type]))
                $SCORES_MAX[$category][$type] = 0;
            if (!isset($SCORES_MAX[$category][$type][$id])) {
                $SCORES_MAX[$category][$type] += $bareme_question["score_max"];
            }
        }
    }
}
?>