<!-- ***************************
     *		  FORMULAIRE       *
     *      d'inscription      *
     *************************** -->

<div class="adapt-height">

	<div class="display-flex first-axe-center">
		<form action="inscription.php" method="post" class="width-40-70 margin-bottom-20">

			<label for="loginPost">Entrez votre pseudo :</label>
			<input type="text" name="loginPost" id="loginPost" placeholder="Pseudo" required/>

			<label for="passwordPost">Entrez votre mot de passe :</label>
			<input type="password" name="passwordPost" id="passwordPost" placeholder="Mot de passe" required/>

			<label for="passwordPostCfrm">Confirmez votre mot de passe :</label>
			<input type="password" name="passwordPostCfrm" id="passwordPostCfrm" placeholder="Confirmation" required/>

			<label for="emailPost">Entrez votre email :</label>
			<input type="email" name="emailPost" id="emailPost" placeholder="Email" class="margin-bottom-20" required/>

			<div class="text-align-center"><input type="submit" value="M'INSCRIRE" class="btn btn-style-3"/></div>
			
		</form>
	</div>

	<div class="text-align-center margin-bottom-20">
	    <a href="index.php"><input type="submit" value="RETOUR" class="btn btn-style-1"/></a>
	</div>

</div>