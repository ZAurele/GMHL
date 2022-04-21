<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
        <title>Bienvenue sur ma page web !</title>
     <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
</head>
<body>

<?php 
include "config/main.php";
$sql = "select distinct username from users";
$req = mysqli_query($link,$sql);

$user = null;
$users = [];

if (!$req){
    report_sql(mysqli_error($link));    
} else {
    $entries = $req->fetch_all(MYSQLI_ASSOC);
    foreach($entries as $entry) {
        array_push($users,$entry["username"]);
    }
}

while (($user == null) || in_array($user, $users)) {
    $user = ucfirst(genererPseudo());
}

function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

$message = '';

if (isset($_POST["pass"]) && $_POST["pass"] == "letMeInIWantToAddANewUserInThisWonderfulWebSite") {
    $password = generatePassword();
    $hash = Password::hashaction($password);

    $values = array(
        "password" => $hash,
        "username" => $user
    );

    insert_request($values,$link,'users');

    $message .= "Bonjour, <br/><br/>";

    $message .= "Vous ne vous êtes pas encore connecté sur le site du <b style='color:orange'>CERPs</b>.<br/>";
    $message .= "De fait, ci-dessous vous trouverez de nouveau vos identifiants et mot de passe (réinitialisé):"."</br>";
    $message .= "<span style='color:green'>C'est un site bénévole, rien de commercial (plus d'infos sur le site)</span>"."</br><br/>";
    $message .= "<b style='color:blue'>LIENDUSITE:</b>       <b style='color:#c92728'>up.aurele.eu</b>"."</br>";
    $message .= "<b style='color:blue'>UTILISATEUR:</b>     <b style='color:orange'>" . $user . "</b></br>";
    $message .= "<b style='color:blue'>MOTDEPASSE:</b>   " . $password . " (à changer sur le site)"."</br></br>";

    $message .= "<br/><br/>";
} else {
    $message = "<form action=\"create_insert.php\" method=\"post\"><input type=\"password\" name=\"pass\"><input type=\"submit\" value=\"Envoyer\"></form>";
}
?>
</br>
</br>
<?=$message?>

<?=Password::hashaction("test");?>
</body>
</html>

<?php 
include "config/end.php";
?>
