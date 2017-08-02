<?php
// ******************************
// *   I - AFFICHAGES DEBUGS 	*
// ******************************

echo "********************************************<br/>";
echo "***** Affichage debug de ce qui a été posté :*****";
var_dump($_POST);


echo "********************************************<br/>";
echo "***** Affichage debug du fichier uploadé : *****<br/>";
var_dump($_FILES);


// équivalent du var_dump :
	
	// NOM du fichier : le nom original du fichier, comme sur le disque du visiteur (exemple : mon_picturePost.png).
	echo '>> File name : ' . $picturePost['name'] . '<br/>';//

	// TYPE/EXTENSION : le type du fichier. Par exemple, cela peut être « image/png ».
	echo '>> File type : ' . $picturePost['type'] . '<br/>';

	// ADRESSE temporaire : l'adresse vers le fichier uploadé dans le répertoire temporaire.
	echo '>> File tmp address : ' . $picturePost['tmp_name'] . '<br/>'; 
	
	// - ERREURS éventuelles : $picturePost['error'] donne le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
	echo '>> Erreurs éventuelles : ';
echo 'error code file : ' . $picturePost['error'] . '<br/>';  
echo "
(- 1 : UPLOAD_ERR_INI_SIZE : fichier dépassant la taille maximale autorisée par PHP.<br/>
- 2 : UPLOAD_ERR_FORM_SIZE : fichier dépassant la taille maximale autorisée par le formulaire.<br/>
- 3 : UPLOAD_ERR_PARTIAL : fichier transféré partiellement.<br/>
- 4 : UPLOAD_ERR_NO_FILE : fichier manquant.)<br/>
";

// - TAILLE :
echo '>> Size file : ' . $picturePost['size'] . '<br/>';

echo "<br/>********************************************<br/>";


// ************************************
// *  II - UPLOAD du fichier IMAGE    *
// *       dans le dossier "img"	  *
// *	   (si vérifications OK) 	  *
// ************************************

if ($picturePost['error'] == 0) {// S'il n'y a pas d'erreur d'upload du fichier (mais il reste à vérifier : 1> l'extension puis 2> la taille du fichier)

	// pour récupérer seulement l'extension :
	// infos à partir du nom du fichier :
	$picturePostInfos = pathinfo($picturePost['name']);

	// On récupère seulement l'extension dans l'array $picturePostInfos :
	$ext = $picturePostInfos['extension'];

	// Array comportant les extensions autorisées :
	$okExt = array('jpg', 'jpeg', 'png', 'gif');
	if (in_array($ext, $okExt)) {// si ce qui est uploadé est bien une image (bonnes extensions) ; ici il faut que "$ext" soit dans l'array "$okExt"
		
		$maxSize = 1048576;// en octets
		if ($picturePost['size'] <= $maxSize) {// et si la taille ne dépasse pas la taille autorisée

			// les tests sont OK ! on va pouvoir effectuer l'upload du fichier :

			// 1> Dans un 1er temps on EFFACE le fichier image précédent, s'il existe, pour faire de la place dans notre dossier img :
			// Ceci ne concerne que l'UPDATE (mise à jour de bouteille) :
			if (isset($_POST['pictureOrigin']) AND $_POST['pictureOrigin'] != "" AND $_POST['pictureOrigin'] != "generic.jpg") {// le fichier image existe et est différent de l'image par défaut
				unlink ('img/' . $_POST['pictureOrigin']);
			} else {
				echo "(Il n'y a pas de fichier image à supprimer)<br/>";
			}


			// 2> Ensuite on upload le fichier en lui donnant le nom souhaité :
			// (note* : on intègre dans le nom l'id de la bouteille. Attention : différence avec la page add-bottle-script, où ce n'est pas forcément le vrai id de la bouteille que l'on intègre dans son nom. Lors de l'update ci-dessous, ce numéro peut donc varier par rapport à celui fixé lors de l'insertion/l'add)


			$nameFile = $nameFileIfUpload;

			$destNameFile = "img/" . $nameFile;
			// Ci-dessous :
			// > $picturePost['tmp_name'] : l'adresse de départ, et :
			// > $destNameFile : la destination : à la fois l'adresse de destination et le nom que prendra le fichier image.

			$result = move_uploaded_file($picturePost['tmp_name'], $destNameFile);
			if ($result) echo "UPLOAD EFFECTUE !<br/>";

		} else {
			$errorAlert = "votre fichier image est trop gros.";
		}

	} else {// si l'ext n'est pas acceptée
		$errorAlert = "votre fichier image n'est pas au bon format (image jpg, jpeg, png, ou gif).";
	}

} else if ($picturePost['error'] != 4) {// si le code d'erreur est différent de 0, c-à-d pour toute sorte d'erreur détectée par PHP ; cependant on exclut le code 4 (cas du fichier manquant : l'utilisateur peut ne pas vouloir mettre d'image)
	$errorAlert = "votre fichier image n'a pas pu être uploadé (fichier trop gros, ou une autre erreur s'est produite lors du transfert).";
}


// Affichage debug du message d'erreur s'il existe :
if(isset($errorAlert)) {// si message d'erreur existant
    echo $errorAlert;// sera transmis via l'url à la page user.php
} else {
    echo "Pas d'errorAlert généré.";
}

?>