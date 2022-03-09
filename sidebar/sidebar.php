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
				<ul>
					<li><a href="?page=main" class="icon fa-home"> Acceuil</a></li>
				</ul>

				<header class="major">
					<h2>Questionnaires</h2>
				</header>
				<ul>
					<?php 
					foreach($QUESTIONS as $category => $cat_cf) {

					?>
					<li>
						<span class="opener">
							<i class="icon fa-<?=$cat_cf["icon"]?>" style="color:<?=$cat_cf["color"]?>"> </i><?=$cat_cf["text"]?>
						</span>
						<ul>
						<?php 
							foreach($cat_cf["values"] as $type => $cf) { ?>
								<li><a href="<?=$cf['url']?>" style="text-transform: none !important;">
									<i class="icon fa-<?=$cf['icon']?>" style="color:<?=$cf['color']?>"></i> <?=$cf['text']?></a></li>
							<?php }
						?>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>

				<header class="major">
					<h2>Résultats</h2>
				</header>
				<ul>
					<?php 
					foreach($QUESTIONS as $category => $cat_cf) {
						$url = '?page=results&amp;category='.$category;
					?>
					<li>
						<a href="<?=$url?>"><i class="icon fa-bar-chart" style="color:<?=$cf['color']?>"></i> <?=$cat_cf["text"]?></a>
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
					<input type="submit" value="Se déconnecter" name="logout" width="100%" class="button small fit"/>
				</form>
			</section>
			
			<footer id="footer">
				<p class="copyright">Site v<?=$version?></br>&copy; GMHL. All rights reserved.</p>
			</footer>
	</div>
</div>
<?php endif;?>