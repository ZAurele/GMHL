<section>
	<form action="" method="post">
	<br/>
		<label>Identifiant :</label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>"/><br/>
		<label>Mot de passe :</label><input type="password" name="password"/><br/>
		<input type="submit" value="Connexion"/>
	</form>
	
</section>