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
                if (Password::verify($password,$row['password'])) {
                    //session_register("username");
                    debug("Connected:".$username);
                    $_SESSION['login_user'] = $username;
                    $_SESSION['login_id'] = $row['id'];
                    $_SESSION['login_appartement'] = $row['appartement'];
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
    
    if ($row['startTime'] == '0000-00-00 00:00:00') {
        $firstlogin = true;
        update_request(array('startTime'=>date('Y-m-d G:i:s')),$link,'users','id',$row['id']);
    } 
    
    $updated_time = $row['modificationTime'];
    $user_id_session = $row['id'];
    $appartement = $row['appartement'];
    $login_session = $row['username'];
    
    $logged = true;
    
    // PROFILS
    $sql = "select * from profils where user_id = '$user_id_session'";
    $ses_sql = mysqli_query($link,$sql);
    $profils_infos = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    
    $profil_found = $profils_infos != null && sizeof($profils_infos)!=0;
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['action'])){
    
            if ($_POST['action'] == 'updateProfil'){
                if (!$profil_found) {
                    $profils_infos = array(
                            "user_id" => $user_id_session,
                            "nom" => '',
                            "prenom" => '',
                            "email" => '',
                            "email_enable" => '',
                            "profil_view" => '',
                            "frequence_notifications" => '',
                            "proprietaire" => false,
                            "description" => '',
                            "etage" => $appartement[0],
                            "syndic" => NULL,
                    		"messageMail" => '',
                    		"notificationMail" => '',
                    		"privateMail" => ''
                    );
                }
                foreach ($profils_infos as $key => $element) {
                    if (isset($_POST[$key])) {
                        $profils_infos[$key] = $_POST[$key];
                    }
                }
                
                if ($profil_found) {
                    update_request($profils_infos,$link,'profils','user_id',$_SESSION['login_id']);
                }
                else {                    
                    insert_request($profils_infos,$link,'profils');
                }
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
?>