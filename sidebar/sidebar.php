<?php if($logged):?>
<div id="sidebar">
	<div class="inner">

		<!-- Search -->
			<section id="search" class="alt">
				<form method="post" action="?page=messages">
					<input type="text" name="search" id="search" placeholder="Search" />
				</form>
			</section>

		<!-- Menu -->
			<nav id="menu">
				<header class="major">
					<h2>Questionnaires</h2>
				</header>
				<ul>
					<?php 
					foreach($QUESTIONS as $category => $cat_cf) {
					?>
					<li>
						<span class="opener"><span class="icon fa-bars"> <?=$cat_cf["text"]?></span></span>
						<ul>
						<?php 
							foreach($cat_cf["values"] as $type => $cf) {
								$sql = "select count(*) as nb from questionnaires where category = '".$category."' and type = '".$type."' and user_id = ".$USER_ID." and answer != ''";
								$req = request($link,$sql,true);
								$rows = $req->fetch_all(MYSQLI_ASSOC);
								$nb = $rows[0]['nb'];

								$values = $QUESTIONS[$category]["values"][$type]["values"];
								$complete =  ''.$nb == ''.count($values);

								$cf['icon'] = $complete ? 'check-square-o' : 'square-o';
								$color = $complete ? '#27ae60' : '#d35400';

								$icon = 'class="icon fa-'.$cf['icon'].'"';
					
								$url = '?page=questions&amp;category='.$category.'&amp;type='.$type;
								echo '<li><a href="'.$url.'" '.$icon.' style="color:'.$color.' !important; text-transform: none !important;"> '.$cf['text'].'</a></li>';
							}
						?>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>

				<header class="major">
					<h2>Résultat</h2>
				</header>
				<ul>
					<?php 
					foreach($QUESTIONS as $category => $cat_cf) {
						$url = '?page=results&amp;category='.$category;
					?>
					<li>
						<span><a href="<?=$url?>"><span class="icon fa-chart-bar"></span> <?=$cat_cf["text"]?></a></span>
					</li>
					<?php
					}
					?>
				</ul>

				<header class="major">
					<h2>Messages</h2>
				</header>
				<?php include "sidebar/menu.php";?>
				</br>
				<header class="major">
					<h2>Configuration</h2>
				</header>
				<?php include "sidebar/menu_config.php";?>
			</nav>
			
			<section class="box calendar">
				<div class="inner">
				<?php include "sidebar/calendar.php";?>
				</div>
			</section>
			
			<section>
				<form action="" method="post">
					<input type="submit" value="Logout" name="logout" width="100%" class="button small fit"/>
				</form>
			</section>
			
			<footer id="footer">
				<p class="copyright">Site v<?=$version?></br>&copy; GMHL. All rights reserved.</p>
			</footer>
	</div>
</div>
<?php endif;?>