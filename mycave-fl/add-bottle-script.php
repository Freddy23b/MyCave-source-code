<?php include("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);


// **********************************
// *   I - Détermination du NUMERO	*
// *	 UNIQUE que prendra le nom 	*
// *	de l'image de la bouteille 	*
// *		($pictureNumber) 		*
// **********************************

// Donner un nom unique au fichier image uploadé, pour éviter l'écrasement d'une image par une autre aillant le même nom :
// en intégrant dans le nom l'id max de la table et en rajoutant 1.
//  Attention : ne sera pas forcément égal à l'id que prendra réellement la bouteille ajoutée : idMax ne prend en compte que les lignes/bouteilles existantes, et oubliera les lignes/bouteilles effacées.
// Cependant, cela convient car la bouteille ajoutée aura toujours une image dont le nom intègre un numéro supérieur par rapport aux autres bouteilles existantes.
$qry = $mycaveDb->query('SELECT MAX(id) AS idMax FROM mycave');
$data = $qry->fetch();
// var_dump($data);
$idMax = $data['idMax'];// $data est un array, avec comme clé 'idMax', et dont la valeur est justement ce dernier id.
// echo $idMax;
$pictureNumber = $idMax + 1;


// ********************************
// *   II - Détermination du      *
// *     NOM du FICHIER IMAGE     *
// *     (à renseigner dans la    *
// *    DB et s'il y a UPLOAD     *
// *     dans le dossier img )    *
// ********************************

// on rentre l'image qui a été postée en variable :
$picturePost = $_FILES['picturePost'];

// Pas de nom si pas de fichier uploadé (à renseigner pour la DB) :
$nameFile = "generic.jpg";

// Nom qui sera pris EN CAS d'upload d'image :
$nameFileIfUpload = $pictureNumber . "." . $picturePost['name'];


// ******************************
// *  III - AFFICHAGES DEBUGS   *
// *           puis             *
// *   UPLOAD du fichier IMAGE  *
// *    dans le dossier "img"   *
// *    (si vérifications OK)   *
// ******************************

include("upload-file-compl.php");


// **************************************
// *   IV - AJOUT bouteille (postée)	*
// *		dans mycaveDb               *
// **************************************

$qry->closeCursor();// libération du curseur pour la requête ci-dessous
// préparation :
$qry = $mycaveDb->prepare('INSERT INTO mycave (name, year, grapes, country, region, description, picture) VALUES (:nameAdd, :yearAdd, :grapesAdd, :countryAdd, :regionAdd, :descriptionAdd, :pictureAdd)');
// exécution :
$qry->execute(array(
    'nameAdd'=>$_POST['namePost'],
    'yearAdd'=>$_POST['yearPost'],
    'grapesAdd'=>$_POST['grapesPost'],
    'countryAdd'=>$_POST['countryPost'],
    'regionAdd'=>$_POST['regionPost'],
    'descriptionAdd'=>$_POST['descriptionPost'],
    'pictureAdd'=>$nameFile// on doit avoir : nom dans la DB = nom dans le dossier "img"
    ));


// ********************************
// *	V - REDIRECTION de 	      *
// *	  l'utilisateur vers 	  *
// *		la bonne page 		  *
// ********************************

// Message à l'utilisateur (AJOUT) :
$msg = 'La bouteille a été ajoutée !';

// S'il y a eu une erreur au niveau de l'upload (avec msg $errorAlert) :
if(isset($errorAlert)) {
	header('Location: user.php?errorAlert=' . $errorAlert);// redirection vers une page informant l'utilisateur de l'erreur d'upload
} else {// s'il n'y a pas d'erreurs
	header('Location: user.php?msg=' . $msg); 
}

?>