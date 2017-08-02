<?php include("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);


// ********************************
// *   I - Détermination du       *
// *     NOM du FICHIER IMAGE     *
// *     (à renseigner dans la    *
// *    DB et s'il y a UPLOAD     *
// *     dans le dossier img )    *
// ********************************

// on rentre l'image qui a été postée en variable :
$picturePost = $_FILES['picturePost'];

// le nom de l'image doit rester inchangé s'il n'y a pas d'upload de fichier image (à renseigner pour la DB) :
$nameFile = $_POST['pictureOrigin'];

// Nom qui sera pris EN CAS d'upload d'image :
$nameFileIfUpload = $_GET['id-url'] . "." . $picturePost['name'];


// ******************************
// *  II - AFFICHAGES DEBUGS    *
// *           puis             *
// *   UPLOAD du fichier IMAGE  *
// *    dans le dossier "img"   *
// *    (si vérifications OK)   *
// ******************************

include("upload-file-compl.php");


// *****************************************
// *   III - MODIFICATION bouteille dans   *
// *		  la DB par remplacement :	   *
// *			origine --> posté		   *
// *****************************************

// préparation :
$qry = $mycaveDb->prepare('UPDATE mycave SET name = :nameAdd, year = :yearAdd, grapes = :grapesAdd, country = :countryAdd, region = :regionAdd, description = :descriptionAdd, picture = :pictureAdd WHERE id = :id');// update sur la bouteille ciblée (id)
// exécution :
$qry->execute(array(
    'nameAdd'=>$_POST['namePost'],
    'yearAdd'=>$_POST['yearPost'],
    'grapesAdd'=>$_POST['grapesPost'],
    'countryAdd'=>$_POST['countryPost'],
    'regionAdd'=>$_POST['regionPost'],
    'descriptionAdd'=>$_POST['descriptionPost'],
    'pictureAdd'=>$nameFile,// on doit avoir : nom dans la DB = nom dans le dossier "img" (cf. note* sur le transfert/upload du fichier)
	'id'=>$_GET['id-url']// je récupère l'id de l'url pour que la modification se fasse sur la bonne bouteille
	));


// ********************************
// *	IV - REDIRECTION de 	  *
// *	  l'utilisateur vers 	  *
// *		la bonne page 		  *
// ********************************

// Message à l'utilisateur (MODIFICATION) :
$msg = 'La bouteille a été modifiée !';

// S'il y a eu une erreur au niveau de l'upload (avec msg $errorAlert) :
if(isset($errorAlert)) {
	header('Location: user.php?errorAlert=' . $errorAlert);// redirection vers une page informant l'utilisateur de l'erreur d'upload
} else {// s'il n'y a pas d'erreurs
	header('Location: user.php?msg=' . $msg);
}

?>