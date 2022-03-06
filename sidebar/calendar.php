<table>
	<caption class="icon fa-calendar"> <?=date('F')?> <?=date('Y')?> </caption>
	<thead>
		<tr>
			<th scope="col" title="Lundi">L</th>
			<th scope="col" title="Mardi">M</th>
			<th scope="col" title="Mercredi">Me</th>
			<th scope="col" title="Jeudi">J</th>
			<th scope="col" title="Vendredi">V</th>
			<th scope="col" title="Samedi">S</th>
			<th scope="col" title="Dimanche">D</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$day = 1;

	for($i=1;$i<=$daysInTheMonth + $firstDayInTheMonth;$i++) {
		$linkStart = '<span>';
		$linkEnd = '</span>';
		$classComplement='';
		$linkExist = false;
		
		$table = 'posts';
		$key1 = 'dateEvenement';
		if (strlen($day) == 1) {
			$key_value1 = date('Y-m-0').$day;
		} else {
			$key_value1 = date('Y-m-').$day;
		}
		$url = '?page=messages&amp;sdate='.$key_value1;
		$sql = "SELECT * FROM ".$table." where $key1 like '$key_value1'";
		
		$req = mysqli_query($link,$sql);
		if (!$req){
			echo mysqli_error($link);
		} else {
			$messages_at_date = $req->fetch_all(MYSQLI_ASSOC);
		}
		
		if (count($messages_at_date) != 0) {
			$linkExist = true;
		}
		
		if ($day == date('j')){
			$classComplement = 'class="today"';
		}
		
		if ($linkExist) {
			$linkStart = '<a href="'.$url.'">';
			$linkEnd = '</a>';
		}
		
		if ($i%7==1 && $i != 1){
			echo '</tr>';
		}
		
		if ($i%7==1 && $i != $daysInTheMonth ){
			echo '<tr>';
		}
		
		if ($i==1){
			echo '<td colspan="'.($firstDayInTheMonth - 1).'" class="pad"><span>&nbsp;</span></td>';
		} else{
			if ($i == ($daysInTheMonth + $firstDayInTheMonth)){
				echo '<td class="pad" colspan="'.($i%7+2).'"><span>&nbsp;</span></td>';
			} 
			else if ($i >= $firstDayInTheMonth){
				echo '<td '.$classComplement.'>'.$linkStart.$day.$linkEnd.'</td>';
				$day++;
			}
		}
	}
	?>
	</tbody>
</table>