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
include "src/functions.php";
include "config/constants.php";
include "configuration.php";



// SRC
include "src/database.php";
include "src/arrays.php";

include "data/src/functions.php";

$link = new mysqli($host,$user,$passwd,$db);

if (mysqli_connect_error()) {    
    die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

include "config/users.php";

// PAGES
//$PAGE = "login.php";
$users_pages = array();
if(isset($_GET['page'])){   
    if(in_array($_GET['page'], $users_pages) && !$logged) {
        $PAGE="login.php";
    } 
    elseif($logged && $_GET["page"] == "login") {
        $PAGE = "main.php";
    } else
    {
        $PAGE = $_GET['page'].".php";    
    }
} else {        
    $PAGE = "main.php";    
}


include "data/mail/mail.php";
include "data/constructs.php";
include "data/posts.php";
include "data/get.php";
include "data/sql.php";
include "data/profil.php";
include "init.php";

include 'data/excels/read.php';
include 'data/src/questions.php';
?>