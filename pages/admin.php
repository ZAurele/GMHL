<?php
function started($user) {
    return $user['startTime'] != '0000-00-00 00:00:00';
}

 if ($_SESSION['login_user'] == "81-1") {
	$sql = "SELECT * FROM users";
	$users = select_request($link,$sql);
    
    $total = count($users);
    
    $started = 0;
    $startedS = 0;
    $nonStarted = '';
    $connectedUsers = array();
    
    foreach ($users as $user) {
                
        if (started($user)) {
            $started++;
        }
        
        if (started($user)) {

            if (explode(' ',$user['modificationTime'])[0] == date('Y-m-d')) {
                echo '<b style="color:green">';
            }
            else if (substr(explode(' ',$user['modificationTime'])[0],0,-3) == date('Y-m')) {
                echo '<b style="color:blue">';
            }
            else if (substr(explode(' ',$user['modificationTime'])[0],0,-3) == date('Y').'-'.date('m',strtotime("-1 month"))) {
                echo '<b style="color:orange">';
            }
            else {
                echo '<b style="color:red">';
            }
            echo explode(' ',$user['modificationTime'])[0].': '.$user['username'].'</b><br>';
        }
    }
    
    foreach ($connectedUsers as $appart => $connected) {
        if (!$connected) {
            $nonStarted .= $appart.' / ';
        } else {
            $startedS++;
        }
    }
    
    echo 'Started: '.$started.'/'.$total.'</br>';
    echo 'StartedS: '.$startedS.'/'.(count($connectedUsers)).'</br>';
    echo 'Non startedS: '.$nonStarted;
 }
?>