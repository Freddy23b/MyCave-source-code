<?php include("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);


// *********************************
// *    I - SUPPRESSION de la      *
// *     bouteille sélectionnée	   *
// *		dans mycaveDb		   *
// *********************************

// Affichage debug de ce qui a été transmis via l'url :
var_dump($_GET['id-url']);// l'id de la bouteille
var_dump($_GET['pictureName-url']);// le nom de la bouteille dans la DB

// 1> préparation : supprimer toute la ligne de la bouteille qui correspond à l'id ciblé :
$qry = $mycaveDb->prepare('DELETE FROM mycave WHERE id = ?');
// 2> exécution :
// on doit prendre l'id capturé via l'url ($_GET) :
$qry->execute(array($_GET['id-url']));


// *********************************
// *    II - SUPPRESSION du 	   *
// *		FICHIER IMAGE 		   *
// *		correspondant		   *
// *********************************

// On effectue la suppression du fichier image s'il existe, et s'il est différent de l'image par défaut :
if (isset($_GET['pictureName-url']) AND $_GET['pictureName-url'] != "" AND $_GET['pictureName-url'] != "generic.jpg") {
	unlink ('img/' . $_GET['pictureName-url']);
} else {
	echo "(Il n'y a pas de fichier image à supprimer)<br/>";
}


// *******************************
// *    III - REDIRECTION		 *
// *		avec MESSAGE 		 *
// *******************************

// Suite à la suppression de mon msg : je l'indique par message à l'utilisateur :
$msg = 'La bouteille a été supprimée !';

// Je redirige vers la page user.php, en incluant mon message ci-dessus, avec GET :
header('Location: user.php?msg=' . $msg);

?>