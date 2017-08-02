<!-- connection à la DB $mycaveDb, mais cette fois pour utiliser la table "users" : -->
<?php include("connect.php");
// affichage debug de la connection à la DB :
// var_dump($mycaveDb);

// Je récupère en variable :
// a> Mon login
$loginPost = $_POST['loginPost'];
// affichage debug :
// var_dump($loginPost);
// b> Mon password "haché" :
$hashPass = sha1($_POST['passwordPost']);
// affichage debug :
// var_dump($hashPass);

// Je récupère mes données dans la DB :
// je sélectionne mes id mais seulement quand le "login" de la table "users" = $loginPost, et idem pour le password :
$qry = $mycaveDb->prepare('SELECT id FROM users WHERE login = :loginCheck AND password = :passwordCheck');
$qry->execute(array(
	'loginCheck'=>$loginPost,
	'passwordCheck'=>$hashPass
	));

// à ce stade :
// - soit je n'ai sélectionné aucun id
// - soit j'ai sélectionné l'id d'une ligne existante dans la table

// Si cette ligne existe, je la parcours avec fetch, et je rentre les résultats obtenus dans l'array $existingUser
// (ici j'y rentre seulement l'id car dans mon "prepare", je n'ai rentré que "SELECT id")
$existingUser = $qry->fetch();
var_dump($existingUser);//renvoit "false" s'il n'y a pas d'utilisateur correspondant dans la table


if (!$existingUser) {// Si je n'ai aucun resultat : je redirige vers -> login.php, en incluant un message de non connexion
	header('Location: login.php?msg=Compte utilisateur non reconnu !');
} else {// si j'en ai un, j'ouvre une session start pour que l'utilisateur ait toujours sa connexion
	session_start();
	// session start où j'insère :
	$_SESSION['idSession'] = $existingUser['id'];// il s'agit de l'id de l'utilisateur concerné, ciblé dans la table users ; 'id' est la clé de l'array $existingUser
	$_SESSION['loginSession'] = $loginPost;// on récupère simplement le login de l'utilisateur, par exemple pour le saluer, ou lui dire au-revoir par la suite

	// et je rentre le login posté dans l'url pour afficher un msg de bienvenue (à n'afficher qu'après s'être logué) :
	header('Location: user.php?loginpost=' . $loginPost);//et je dirige vers user.php
} ?>