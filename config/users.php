<?php
$login_session = "";
$logged = false;
$user_id_session = null;

class Password {
    const SALT = 'JaiemeBienCoder';
 
    public static function hashaction($password) {
        return hash('sha512', self::SALT . $password);
    }
 
    public static function verify($password, $hash) {
        return (strcmp($hash,self::hashaction($password)) == 0);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['logout'])) {
        session_destroy();
    } else {
        if (!empty($_POST['username']) && !empty($_POST['password'])){
            $username = format($_POST['username']);
            $password = format($_POST['password']);

            $sql = 'SELECT * FROM users where username = "'.$username.'"';
            
            $req = mysqli_query($link,$sql);
            if (!$req){
                echo mysqli_error($link);
                $count = 0;
            } else {
                $row = mysqli_fetch_array($req,MYSQLI_ASSOC);
                $count = mysqli_num_rows($req);
            }                    

            if($count == 1) { 
                debug("Found user ".implode(",",$row))    ;  
 
                if (Password::verify(trim($password),$row['password'])) {
                    //session_register("username");
                    debug("Connected:".$username);
                    $_SESSION['login_user'] = $username;
                    $_SESSION['login_id'] = $row['id'];
                }
            }
        }
    }
    
}

if(isset($_SESSION['login_user']) && empty($_POST['logout'])){
    // USERS
    $user_check = $_SESSION['login_user'];
    $sql = "select * from users where username = '$user_check'";
    $ses_sql = mysqli_query($link,$sql);
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    
    $DATE = explode(' ',$row['modificationTime'])[0];
        
    if ($DATE != date('Y-m-d') || $row['connexions'] == "") {
        
        $old_connexions = $row['connexions'];
        
        if ($old_connexions == "") {
            $connexions = date('Y-m-d');
        } else {
            $connexions = $old_connexions.','.date('Y-m-d');
        }
        update_request(array('connexions'=>$connexions),$link,'users','id',$row['id']);
    }
    
    $firstlogin = false;
    if ($row['startTime'] == '0000-00-00 00:00:00') {
        $firstlogin = true;
        update_request(array('startTime'=>date('Y-m-d G:i:s')),$link,'users','id',$row['id']);
    } 
    
    $updated_time = $row['modificationTime'];
    $user_id_session = $row['id'];
    $login_session = $row['username'];
    
    $logged = true;
    
    // PROFILS
    $default_profils_infos = array(
        "user_id" => $user_id_session,
        "nom" => '',
        "prenom" => '',
        "email" => '',
        "email_enable" => '',
        "profil_view" => '',
        "frequence_notifications" => '',
        "country" => "fr",
        "description" => '',
        "messageMail" => '',
        "notificationMail" => '',
        "privateMail" => ''
    );

    $sql = "select * from profils where user_id = '$user_id_session'";
    $ses_sql = mysqli_query($link,$sql);
    $PROFILS = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    
    if(!($PROFILS != null && sizeof($PROFILS)!=0)) {
        insert_request($default_profils_infos,$link,'profils');
        $PROFILS = $default_profils_infos;
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['action'])){
            if ($_POST['action'] == 'updateProfil'){
                foreach ($PROFILS as $key => $element) {
                    if (isset($_POST[$key])) {
                        $PROFILS[$key] = $_POST[$key];
                    }
                }
                
                update_request($PROFILS,$link,'profils','user_id',$_SESSION['login_id']);
            }
        }
    } 
}

if (isset($_GET['nonVu'])) {
    $_SESSION['nonVu'] = $_GET['nonVu'];
} else {
	$_SESSION['nonVu'] = False;
}

if (isset($_GET['nonVuC'])) {
	$_SESSION['nonVuC'] = $_GET['nonVuC'];
} else {
	$_SESSION['nonVuC'] = False;
}

if (isset($_SESSION['home'])) {
	$_SESSION['nonVu'] = False;
	$_SESSION['nonVuC'] = False;
}

if($logged) {
    $admin = false;
    if ($login_session == "aurele") {
        $admin = true;
    }
}

$USER_ID = isset($_SESSION['login_id']) ? $_SESSION['login_id']: -1;

$PSEUDO = get_user_pseudo($USER_ID)
?>