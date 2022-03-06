<?php 
if (isset($_GET['private'])) {
	if ($_GET['private']) {
		echo '<section><div style="float:right;">';
		if (isset($_GET['archive'])) {
			if ($_GET['archive']) {
				echo '<a href="'.get_url(array('archive'=>'0'),NULL).'" class="icon fa-archive"> Non vus</a>';
			} else {
				echo '<a href="'.get_url(array('archive'=>'1'),NULL).'" class="icon fa-archive"> Vus (Achives)</a>';
			}
		} else {
			echo '<a href="'.get_url(array('archive'=>'1'),NULL).'" class="icon fa-archive"> Vues (Achives)</a>';
		}
		echo '</div></section>';
	}
}
?>