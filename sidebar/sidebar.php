
<div id="sidebar">
	<div class="inner">

		<!-- Search -->
			<section id="search" class="alt" style="display:none">
				<form method="post" action="?page=messages">
					<input type="text" name="search" id="search" placeholder="Search" />
				</form>
			</section>

		<!-- Menu -->

			<nav id="menu">
				<ul>
					<li><a href="?page=accueilducerp" class="icon fa-home"> Accueil</a></li>
				</ul>

				<header class="major">
					<h2>A propos du CERP</h2>
				</header>

				<ul>
					<li><a href="?page=histoireducerp" span class="icon fa-lightbulb"> Histoire du CERP</a></li>
					<li><a href="?page=methodecerp" span class="icon fa-light fa-flask"></i> L'étude</a></li>
	
					<li>
						<span class="opener"><span class="icon fa-users"> Les acteurs</span></span>
						<ul>
							<li><a href="?page=quisommesnous" class="icon fa-users"> Membres fondateurs</a></li>
							<li><a href="?page=partenairestechniques" class="icon fa-user-plus"> Partenaires techniques</a></li>
							<li><a href="?page=partenairesfinanciers" class="icon fa-child"> Partenaires financiers </a></li>
							<li><a href="?page=correspondantslocaux" class="icon fa-user"> Trombinoscope </a></li>			
						</ul>
					</li>

					<li>
						<span class="opener"><span class="icon fa-book"> Les Ressources</span></span>
						<ul>
							<li><a href="?page=mesdroits" class="icon fa-gavel"> Connaître mes droits</a></li>
							<li><a href="?page=facteurschoix" class="icon fa-question"> Pourquoi ces facteurs</a></li>
							<li><a href="?page=ressources" class="icon fa-book"></i> Ressources utiles</a></li>
							<li><a href="?page=bibliographie" class="icon fa-circle"></i> Références bibliographiques</a></li>
						</ul> 
					</li>
				</ul>

				<?php if($logged):?>
				<header class="major">
					<h2>Enquètes</h2>
				</header>
				<ul>
					<?php 
					foreach($QUESTIONS as $category => $cat_cf) {
						if (isset($cat_cf["disabled"]) && $cat_cf["disabled"]) continue;
						$url = '?page=results&amp;category='.$category;
						?>
						<li>
						<a href="<?=$url?>"><i class="icon fa-bar-chart" style="color:<?=$cat_cf['color']?>"></i> <?=$cat_cf["text"]?></a>
						</li>
						<?php
					}
					?>
				</ul>
				<? endif;?>

				<?php /*include "sidebar/menu.php";*/?>
				
				<header class="major">
				<h2>Configuration</h2>
				</header>
			
				<ul>	
				<?php include "sidebar/menu_config.php";?>
			</nav>
			
			<!--<section class="box calendar">
				<div class="inner">
				<?php include "sidebar/calendar.php";?>
				</div>
			</section>-->
			
			
			<footer id="footer">
				<p class="copyright">Site v<?=$VERSION_SITE?></br><?=date("Y")?> &copy; Projet CERP. All rights reserved.</p>
			</footer>
	</div>
</div>
