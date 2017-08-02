<?php $activePage = 'login'; ?><!-- reconnaissance : "je suis sur la page login" -->


<!-- HEADER -->
<?php include("header.php"); ?>

<div class="adapt-height">
	<div class="display-flex first-axe-center margin-bottom-20">

		<form action="login-script.php" method="post" class="width-40-70 text-align-center">

			<input type="text" name="loginPost" placeholder="Pseudo">

			<input type="password" name="passwordPost" placeholder="Mot de passe" class="margin-bottom-20">

			<input type="submit" value="VALIDER" class="btn btn-style-3">
			
		</form>
	</div>
	<div class="text-align-center margin-bottom-20">
		    <a href="index.php"><input type="submit" value="ANNULER" class="btn btn-style-1"/></a>

		<?php
		// si l'on n'a pas de $existingUser car rien n'a été récupéré dans la table "users" (cf. login-script.php) : on a alors un message de non connexion récupéré par GET (vie l'url) depuis login-script.php :
		if (isset($_GET['msg'])) { ?>
			<p class="prune-font italic"><?php echo $_GET['msg']; ?></p>
		<?php } ?>


	</div>
</div>


<!-- FOOTER -->
<?php include("footer.php"); ?>