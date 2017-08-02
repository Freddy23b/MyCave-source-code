<?php $activePage = 'bottle-selected-r'; ?>


<!-- insertion header -->
<?php include("header.php"); ?>


<?php include ("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);


// ********************************************
// *          I - AFFICHAGE de la             *
// *          bouteille sélectionnée          *     
// ********************************************

// affichage debug de l'id de la bouteille sélectionnée, id pris via l'url :
// var_dump($_GET['id-url']);

// 1) Récupération de la bouteille qui a été sélectionnée :
// préparation :
$qry = $mycaveDb->prepare("SELECT id, name, year, grapes, country, region, description, picture FROM mycave WHERE id= ?");
// exécution :
// (rappel : $_GET['id_url'] = $data['id'] sur la page où je sélectionne ma bouteille : il s'agit donc bien de l'id ciblé/sélectionné par l'utilisateur)
$qry->execute(array($_GET['id-url']));

// Je parcours les données (la ligne) correspondantes à l'id ciblé :
$data = $qry->fetch();
// var_dump($data);
?>


<!-- 2) On peut maintenant afficher les données avec "echo $data['clé de la valeur ciblée'];" : -->
<?php include("bottle-selected-table.php"); ?>

<div class="text-align-center margin-bottom-20">
	<!-- btn retour à l'accueil -->
	<a href="index.php"><input type="submit" value="RETOUR" class="btn  btn-style-1"/></a>
</div>


<!-- footer -->
<?php include("footer.php"); ?>