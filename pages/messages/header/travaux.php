<?php 
// previous
if ($message['travaux'] != 0 && $author) {
	echo '<a href="'.get_url(array('travaux'=>'0-'.$message['id']),NULL).'">';
	switch ($message['travaux']) {
		case '1':
			echo 'Vue';
			break;
		case '2':
			echo 'Signalé';
			break;
		case '3':
			echo 'En cours';
			break;
	}
	echo '</a> &#10142; ';
}

// current
switch ($message['travaux']) {
	case '0':
		echo '<b style="color:red">Vue</b>';
		break;
	case '1':
		echo '<b style="color:orange">Signalé</b>';
		break;
	case '2':
		echo '<b style="color:blue">En cours</b>';
		break;
	case '3':
		echo '<b style="color:green">Fini</b>';
		break;
}
// next
if ($message['travaux'] != 3) {
	echo ' &#10142; ';
}
if ($message['travaux'] != 3 && $author) {
	echo '<a href="'.get_url(array('travaux'=>'1-'.$message['id']),NULL).'">';
}
switch ($message['travaux']) {
	case '0':
		echo 'Signalé ';
		break;
	case '1':
		echo 'En cours ';
		break;
	case '2':
		echo 'Fini ';
		break;
}
if ($message['travaux'] != 3 && $author) {
	echo '</a>';
}
?>