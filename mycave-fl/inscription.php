<?php $activePage = 'inscription'; ?>

<?php
include("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);
?>

<?php
// affichage debug de ce qui a été posté :
// var_dump($_POST);
// print_r($_POST);
?>

<?php
// insertion header
include("header.php");
?>

<?php
if (!isset($_POST['loginPost'])) { // T1> si rien n'a été posté : on affiche seulement le formulaire -->

	include('inscription-form.php');

} else if (isset($_POST['loginPost'])) {// T1> quelque chose a été posté

	if ($_POST['passwordPost'] != $_POST['passwordPostCfrm']) { ?><!-- T2> les 2 mots de passe tappés sont différents -->
		
		<div class="text-align-center">
			<p class="prune-font font-size-1-4 italic">Vous n'avez pas confirmé le même mot de passe.</p>
		</div>
		
		<!-- on réaffiche le formulaire -->
		<?php include('inscription-form.php');


	} else if ($_POST['passwordPost'] === $_POST['passwordPostCfrm']) { // T2>les 2 mots de passe sont bien identiques
	
		// On prépare le Test 3 : le pseudo ou l'email existent-ils déjà dans la DB ?
		// Dans la table "users" : je recherche s'il y a déjà une ligne comprenant le même pseudo ou le même email :
		$qry = $mycaveDb->prepare('SELECT id FROM users WHERE login = :loginTest OR email = :emailTest');
		$qry->execute(array(
			'loginTest'=>$_POST['loginPost'],
			'emailTest'=>$_POST['emailPost']
			));
		// Je parcours ma requête :
		$result = $qry->fetch();

		if ($result) { ?><!-- T3 : j'ai un résultat : je ne dois pas faire l'insertion dans la DB : -->

			<div class="text-align-center">
				<p class="prune-font font-size-1-4 italic">Le pseudo que vous avez choisi, ou votre email, existent déjà dans notre base de donnée</p>
			</div>
			
			<!-- on réaffiche le formulaire -->
			<?php include('inscription-form.php');


		} else if (!$result) {// T3 : si je n'ai pas de résultat : c'est bon, tous les tests sont ok : on fait l'insertion

			// **********************************
			// *		INSERTION nouvel	    *
			// *	 utilisateur dans la DB     *
			// **********************************

			// Je récupère mon passwordPost en variable, et "haché" :
			$hashPass = sha1($_POST['passwordPost']);

			$qry->closeCursor();// libération du curseur pour la requête ci-dessous
			// préparation :
			$qry = $mycaveDb->prepare('INSERT INTO users (login, password, email, inscription_date) VALUES (:loginAdd, :passwordAdd, :emailAdd, NOW())');
			// exécution :
			$qry->execute(array(
			    'loginAdd'=>$_POST['loginPost'],
			    'passwordAdd'=>$hashPass,
			    'emailAdd'=>$_POST['emailPost']
			    ));


			// **********************************
			// *		Ouverture directe	    *
			// *	   d'une SESSION START      *
			// **********************************

			// pour ouvrir une session start, je dois aussi récupérer l'id de cet utilisateur nouvellement inséré, comme sur login-script (cf. commentaires sur la page login-script.php) :
			$qry->closeCursor();// libération du curseur pour la requête ci-dessous
			$qry = $mycaveDb->prepare('SELECT id FROM users WHERE login = :loginInserted');
			$qry->execute(array(
				'loginInserted'=>$_POST['loginPost'],
				));
			
			$newUser = $qry->fetch();
			// var_dump($newUser);

			session_start();
			$_SESSION['idSession'] = $newUser['id'];
			$_SESSION['loginSession'] = $_POST['loginPost'];
			?>

			<div class="text-align-center adapt-height">

				<p class="prune-font font-size-1-4 italic">Votre compte est bien créé !</p>
				
				<!-- le retour doit ici se faire sur user.php ! On n'oublie pas de transmettre le login posté -->
				<a href="user.php?loginpost=<?php echo $_POST['loginPost'] ?>"><input type="submit" value="ACCUEIL" class="btn btn-style-1"/></a>

			</div>

		<?php }// T3
	}// T2
}// T1

// FOOTER
include("footer.php");