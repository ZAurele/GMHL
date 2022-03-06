<?php 
###################################################################
# REQUESTS
###################################################################
function update_request($datas,$link,$table,$key,$key_value) {
	$complement_sql = " WHERE $key = '$key_value'";

	$sql_update = "UPDATE $table SET ";
	foreach (array_keys($datas) as $data){
		$formatted = format($datas[$data]);
		if (!empty($formatted)) {
			$datas[$data] = $formatted;
		}
		$sql_update .= $data." = '".$datas[$data]."',";
	}
	$sql_update = substr($sql_update, 0, -1);
	$sql_update .= $complement_sql;

	$req = mysqli_query($link,$sql_update);


	if (!$req){
		echo mysqli_error($link);

	} else {
		report_sql('REQUEST:'.$sql_update);
	}
}

function insert_request($datas,$link,$table) {

	$sql_insert = "INSERT INTO $table (";

	foreach (array_keys($datas) as $data){
		$formatted = format($datas[$data]);
		if (!empty($formatted)) {
			$datas[$data] = $formatted;
		}

		$sql_insert .= $data.",";
	}
	$sql_insert = substr($sql_insert, 0, -1);
	$sql_insert .= ") VALUES (";

	foreach (array_keys($datas) as $data){
		$sql_insert .= "'".$datas[$data]."',";
	}
	$sql_insert = substr($sql_insert, 0, -1);
	$sql_insert .= ")";

	$req = mysqli_query($link,$sql_insert);

	report_sql('REQUEST:'.$sql_insert);

	if (!$req){
		report_sql(mysqli_error($link));
	}
}

function request($link, $sql, $no_log=false) {
	$req = mysqli_query($link,$sql);

	if(!$no_log) 
		report_sql('REQUEST:'.$sql);

	if (!$req){
		report_sql(mysqli_error($link));
	}
	return $req;
}

function select_request($link,$sql, $no_log=true){
	$req = mysqli_query($link,$sql);

	if(!$no_log) 
		report_sql('REQUEST:'.$sql);
	
	if (!$req){
		report_sql(mysqli_error($link));
		return NULL;
	}
	
	return $req->fetch_all(MYSQLI_ASSOC);
}

function select_request_s($link,$table,$all,$key,$key_value){
	$id = 'id';
	if ($table == 'profils') {
		$id = 'user_id';
	}

	if ($key != NULL) {
		$sql = "SELECT * FROM $table where $key = '$key_value' order by $id DESC";
	} else {
		$sql = "SELECT * FROM $table order by $id DESC";
	}

	$req = mysqli_query($link,$sql);

	if (!$req){
		report_sql(mysqli_error($link));
		return NULL;
	}
	
	if ($all) {
		return $req->fetch_all(MYSQLI_ASSOC);
	}
	else {
		return mysqli_fetch_array($req,MYSQLI_ASSOC);
	}
}

###################################################################
# SET UNSET
###################################################################
function set_unset_values($link,$name,$dbname,$table,$keyUnique) {
	if (isset($_GET[$name])) {
		$elements = explode('-',$_GET[$name]);
		$element = $elements[0];
		$id = $elements[1];
		
		set_unset_values_specified($link,$dbname,$table,$element,$keyUnique,$id);
	}
}

function set_unset_values_specified($link,$dbname,$table,$element,$keyUnique,$id,$set=3) {
	$unset = false;
	$temp = select_request_s($link, $table,false,$keyUnique,$id);

	$values = explode(',',$temp[$dbname]);

    $valuesString = '';
    
	if ($set == 3 || $set) {
		if ($temp[$dbname] != '') {
				
			if(!in_array($element, $values)) {
				$valuesString = $temp[$dbname].','.$element;
			}
		} else{
			$valuesString = $element;
		}
	} else {
		$valuesString = $temp[$dbname];
	}

	if ($set == 3 || !$set) {
		debug('unset '.$element);

		if( (($key = array_search($element, $values)) != false) || ($temp[$dbname] == $element)) {
			debug('unset in array');
				
			if ($temp[$dbname] == $element) {
				$valuesString = '';
			} else {
				unset($values[$key]);

				foreach ($values as $key_emp => $value_emp) {
					if (is_null($value_emp) || $value_emp=="") {
						unset($values[$key_emp]);
					}
				}

				$valuesString = implode(',',$values);
			}
			$unset = true;
		}
	}

	update_request(array($dbname=>format($valuesString)),$link, $table,$keyUnique,$id);
}

function set_values_specified($link,$dbname,$table,$element,$keyUnique,$id) {
	set_unset_values_specified($link,$dbname,$table,$element,$keyUnique,$id,$set=true);
}

function set_values_specified_for_all_users($link,$dbname,$table,$element,$keyUnique,$id) {

	$users = select_request($link,"SELECT * FROM users where id <> ".$id);

	foreach ($users as $user) {
		set_unset_values_specified($link,$dbname,$table,$element,$keyUnique,$user['id'],$set=true);
	}
}

function mailForAllUsers($link,$profils_infos,$date,$user_id_session,$type) {
	$profils = select_request($link,"SELECT * FROM profils where user_id <> $user_id_session");
	
	switch($type) {
		case 'new_comment':
			$title = 'Nouveau commentaire';
			$activationName = 'notificationMail';
			break;
		case 'update_comment':
			$title = 'Commentaire modifié';
			$activationName = 'notificationMail';
			break;
		case 'new_message':
			$title = 'Nouveau message';
			$activationName = 'messageMail';
			break;
		case 'update_message':
			$title = 'Message modifié';
			$activationName = 'messageMail';
			break;
		case 'new_private':
			$title = 'Nouveau message privé';
			$activationName = 'privateMail';
			break;
		case 'update_private':
			$title = 'Message privé modifié';
			$activationName = 'privateMail';
			break;
	}
	
	
	foreach ($profils as $profils_infos) {
	
		if(($profils_infos[$activationName] == 'on')){
			goMail($link,$profils_infos,$title,$date);
		}
	}
}

function unset_values_specified($link,$dbname,$table,$element,$keyUnique,$id) {
	set_unset_values_specified($link,$dbname,$table,$element,$keyUnique,$id,$set=false);
}


?>