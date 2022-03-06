<!-- Form -->
	<section>
		<div class="posts">
		
			<article>
				<h3 style="color:red;" class="icon fa-thermometer"> Chauffage</h3>
				<p></p>
			</article>
			
			<article>
				<h3 style="color:orange;" class="icon fa-shower"> Eau chaude </h3>
				<p>dggd</p>
			</article>
			
			<article>
				<h3 style="color:red;" class="icon fa-bolt"> Electricité </h3>
				<p></p>
			</article>
			
			<article>
				<h3 style="color:blue;" class="icon fa-cogs"> Ascenseur </h3>
				<p></p>
			</article>
			
		</div>
	</section>
	<br/>
	<form method="post" action="#">
		<div class="row uniform">
			
			<div class="12u$"><h3 class="icon fa-thermometer-full"> Chauffage</h3></div>
			<!-- Break -->
			<div class="4u 12u$(xsmall)">
				<input type="radio" id="chauffage_oui" name="chauffage" value='0' >
				<label for="chauffage_oui"><span class="icon fa-thermometer" style="color:<?=$etats['0'][0]?>;"> Oui</span></label>
			</div>
			<div class="4u 12u$(xsmall)">
				<input type="radio" id="chauffage_un_peu" name="chauffage" value='2' >
				<label for="chauffage_un_peu"><span class="icon fa-thermometer-half" style="color:<?=$etats['2'][0]?>;"> Un peu</span></label>
			</div>
			<div class="4u$ 12u$(xsmall)">
				<input type="radio" id="chauffage_non" name="chauffage" value='4' >
				<label for="chauffage_non"><span class="icon fa-thermometer-0" style="color:<?=$etats['4'][0]?>;"> Non</span></label>
			</div>
			
			<div class="12u$"><h3 class="icon fa-shower"> Eau chaude</h3></div>
			<!-- Break -->
			<div class="4u 12u$(xsmall)">
				<input type="radio" id="eau_oui" name="eau" value='0' >
				<label for="eau_oui"><span class="icon fa-thermometer" style="color:<?=$etats['0'][0]?>;"> Oui</span></label>
			</div>
			<div class="4u 12u$(xsmall)">
				<input type="radio" id="eau_un_peu" name="eau" value='2'>
				<label for="eau_un_peu"><span class="icon fa-thermometer-half" style="color:<?=$etats['2'][0]?>;"> Un peu</span></label>
			</div>
			<div class="4u$ 12u$(xsmall)">
				<input type="radio" id="eau_non" name="eau" value='4'>
				<label for="eau_non"><span class="icon fa-thermometer-0" style="color:<?=$etats['4'][0]?>;"> Non</span></label>
			</div>
			
			<div class="12u$">
				<h3 class="icon fa-bolt"> Electricite</h3>
			</div>
			<!-- Break -->
			<div class="6u 12u$(xsmall)">
				<input type="radio" id="elec_oui" name="elec" value='0' <?php if ($etat_elec['etat'] == '0'){echo'checked';}?>>
				<label for="elec_oui"><span class="icon fa-bolt" style="color:<?=$etats['0'][0]?>;"> Oui</span></label>
			</div>
			<div class="6u$ 12u$(xsmall)">
				<input type="radio" id="elec_non" name="elec" value='4' <?php if ($etat_elec['etat'] == '4'){echo'checked';}?>>
				<label for="elec_non"><span class="icon fa-bolt" style="color:<?=$etats['4'][0]?>;"> Non</span></label>
			</div>
			
			<div class="12u$">
				<h3 class="icon fa-cogs"> Ascenseur</h3>
			</div>
			<!-- Break -->
			<div class="6u 12u$(xsmall)">
				<input type="radio" id="ascenseur_oui" name="ascenseur" value='0' <?php if ($etat_ascenseur['etat'] == '0'){echo'checked';}?>>
				<label for="ascenseur_oui"><span class="icon fa-cogs" style="color:<?=$etats['0'][0]?>;"> Oui</span></label>
			</div>
			<div class="6u$ 12u$(xsmall)">
				<input type="radio" id="ascenseur_non" name="ascenseur" value='4' <?php if ($etat_ascenseur['etat'] == '4'){echo'checked';}?>>
				<label for="ascenseur_non"><span class="icon fa-cog" style="color:<?=$etats['4'][0]?>;"> Non</span></label>
			</div>
			
			<!-- Break -->
			<div class="12u$">
				<ul class="actions">
					<input type="hidden" name="action" value="updateHabitation">
					<li><input type="submit" value="Mettre à jour" class="special" /></li>
				</ul>
			</div>
		</div>
	</form>