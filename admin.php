<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
        <title>Bienvenue sur ma page web !</title>
     <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
</head>
<body style="text-align: -webkit-center;">

</br>
</br>
<div style="display:flex;flex-direction:column;width: 50%;">
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
$hh = Password::hashaction("letMeInIWantToAddANewUserInThisWonderfulWebSite");

if (isset($_POST["pass"])) {
    $_SESSION["pass"] = Password::hashaction($_POST["pass"]);
}

$pass = isset($_SESSION["pass"]) ? $_SESSION["pass"] : null;
$access = $pass == $hh;

if ($access && isset($_GET["add_user"])) {
    $password = generatePassword();
    $hash = Password::hashaction($password);

    $values = array(
        "password" => $hash,
        "username" => $user
    );

    insert_request($values,$link,'users');
    ?>

    <a href="?">Retour</a>

    <div style="text-align:left;width:50%">
    Bonjour, <br/><br/>

    Vous trouverez ci-dessous vos identifiants pour le site du <b style='color:orange'>CERPs</b>.<br/>
    <span style='color:green'>C'est un site bénévole, rien de commercial (plus d'infos sur le site)</span>.</br><br/>
    <b style='color:blue'>LIENDUSITE:</b>       <b style='color:#c92728'>projetcerp.com</b>.</br>
    <b style='color:blue'>UTILISATEUR:</b>     <b style='color:orange'><?=$user?></b></br>
    <b style='color:blue'>MOTDEPASSE:</b>  <?=$password?> (à changer sur le site).</br></br>

    </div>

    <?php
}  elseif($access && isset($_GET["extract"])) {
    $sql = "SELECT * FROM questionnaires order by update_date DESC";
    $rows = select_request($link,$sql,true);

    $headers = array();
    $header = '';
    $lines = array();
    foreach($rows as $row):
        $line = '';
        foreach($row as $key => $value):
            if ($header == '') array_push($headers, trim($key));
            $line = $line.$value.";";
        endforeach;
        array_push($lines, $line);

        if ($header == '') $header = join(';', $headers);
    endforeach;

    $content = $header."\n".join("\n",$lines);
    ?>
    <textarea id="text" hidden><?=$content?></textarea>
    <a href="?">Retour</a>
    <br/>
    <input type="button" id="btn" value="Download" />
    <script>
        function download(filename, textInput) {
            var element = document.createElement('a');
            element.setAttribute('href','data:text/plain;charset=utf-8, ' + encodeURIComponent(textInput));
            element.setAttribute('download', filename);
            document.body.appendChild(element);
            element.click();
            //document.body.removeChild(element);
            }
            document.getElementById("btn")
            .addEventListener("click", function () {
                var text = document.getElementById("text").value;
                var filename = "<?=date("Y-m-d H:i:s")?>.csv";
                download(filename, text);
            }, false);
        </script>

    <?php
} elseif($access) {
    ?>
    
        <a href="?add_user=y" style="margin-top:20px;">Ajouter un utilisateur</a>
        <a href="?extract=y" style="margin-top:20px;">Extraire les résultats</a>
    
    <?php
} else {
    ?>

    <form action="create_insert.php" method="post"><input type="password" name="pass"><input type="submit" value="Envoyer">
    </form>

    <?php
}
?>
</div>

</body>
</html>

<?php 
include "config/end.php";
?>