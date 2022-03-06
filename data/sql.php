<?php
// HABITATION
$select_habitation_state = false;
if (!isset($_GET['page'])) {
	$select_habitation_state = true;
} elseif ($_GET['page'] == "habitation" || $_GET['page'] == "main"){
	$select_habitation_state = true;
}


?>