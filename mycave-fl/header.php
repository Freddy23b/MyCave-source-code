<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <!-- modification du title en fonction de la page consultée -->
    <title>
        <?php
            if ($activePage === 'index') {
                echo 'Accueil My CAVE : consultation';
                // Changer le background-color du HEADER et du FOOTER en fonction de : visiteur / utilisateur connecté :
                $bkgdColorHeadFoot = "mauve-bkgd";
            } else if ($activePage === 'bottle-selected-r') {
                echo 'Bouteille : consultation';
                $bkgdColorHeadFoot = "mauve-bkgd";
            } else if ($activePage === 'user') {
                echo 'Accueil utilisateur connecté - My CAVE';
                $bkgdColorHeadFoot = "brdx-bkgd";
            } else if ($activePage === 'add-bottle-post') {
                echo "Ajout d'une bouteille";
                $bkgdColorHeadFoot = "brdx-bkgd";
            } else if ($activePage === 'bottle-selected-rud') {
                echo "Mise à jour ou suppression d'une bouteille";
                $bkgdColorHeadFoot = "brdx-bkgd";
            } else if ($activePage === 'update-bottle-post') {
                echo "Mettre à jour une bouteille";
                $bkgdColorHeadFoot = "brdx-bkgd";
            } else if ($activePage === 'login') {
                echo 'Connection utilisateur';
                $bkgdColorHeadFoot = "mauve-bkgd";
            } else if ($activePage === 'inscription') {
                echo "Inscrivez-vous !";
                $bkgdColorHeadFoot = "mauve-bkgd";
            }
        ?>
    </title>

    <!-- l'icône de l'onglet à gauche du title -->  
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

    <meta name="description" content="Mycave, application Web de gestion de cave à vin">

    <!-- pour la lisibilité sur mobiles -->
    <meta name="viewport" content="width=device-width"/>
    
    <!-- feuille de style CSS associée -->
    <link rel="stylesheet" type="text/css" href="_css/style.css">

</head>


<header class="header margin-bottom-20 <?php echo $bkgdColorHeadFoot; ?> white-font">

    <!-- j'adapte le contenu de mon header en fonction de la page sur laquelle je suis : -->
    <?php if ($activePage === 'index') { ?>

        <a href="#"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a><!-- le lien de l'accueil peut changer en fonction de la page -->

        <h1 class="text-align-center">ACCUEIL : CONSULTATION</h1>

        <div class="margin-right-1">
            <!-- Espace de connexion : -->
            <a href="login.php"><input type="submit" value="CONNEXION" class="btn btn-style-2"/></a>
            <!-- Espace d'inscription : -->
            <a href="inscription.php"><input type="submit" value="INSCRIPTION" class="btn btn-style-2"/></a>            
        </div>


    <?php } else if ($activePage === 'bottle-selected-r') { ?>

        <a href="index.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>

        <h1 class="not-bold text-align-center">Bouteille : consultation</h1>

        <div class="margin-right-1">
            <!-- Espace de connexion : -->
            <a href="login.php"><input type="submit" value="CONNEXION" class="btn btn-style-2"/></a>
            <!-- Espace d'inscription : -->
            <a href="inscription.php"><input type="submit" value="INSCRIPTION" class="btn btn-style-2"/></a>
        </div>


    <?php } else if ($activePage === 'user') { ?>

        <a href="#"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>

        <h1 class="text-align-center">ACCUEIL UTILISATEUR</h1>

        <div class="margin-right-1">
            <!-- l'utilisateur : -->
            <input type="submit" value="<?php echo $_SESSION['loginSession']; ?>" class="user-display">
            <!-- Espace de déconnexion : -->
            <a href="delogin-script.php"><input type="submit" value="DECONNEXION" class="btn btn-style-2 ajust-font-size"/></a>
        </div>


    <?php } else if ($activePage === 'add-bottle-post') { ?>

        <a href="user.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>
        
        <h1 class="text-align-center not-bold">Ajouter une bouteille</h1>

        <div class="margin-right-1">
            <!-- l'utilisateur : -->
            <input type="submit" value="<?php echo $_SESSION['loginSession']; ?>" class="user-display">
            <!-- Espace de déconnexion : -->
            <a href="delogin-script.php"><input type="submit" value="DECONNEXION" class="btn btn-style-2 ajust-font-size"/></a>
        </div>


    <?php } else if ($activePage === 'bottle-selected-rud') { ?>

        
        <a href="user.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>
        
        <h1 class="text-align-center long-h1 not-bold">Modifier ou supprimer une bouteille</h1>
    
        <div class="display-flex margin-right-1">
            <!-- l'utilisateur : -->
            <input type="submit" value="<?php echo $_SESSION['loginSession']; ?>" class="user-display">
            <!-- Espace de déconnexion : -->
            <a href="delogin-script.php"><input type="submit" value="DECONNEXION" class="btn btn-style-2 ajust-font-size"/></a>
        </div>
        

    <?php } else if ($activePage === 'update-bottle-post') { ?>

        <a href="user.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>

        <h1 class="text-align-center not-bold">Modifier une bouteille</h1>

        <div class="margin-right-1">
            <!-- l'utilisateur : -->
            <input type="submit" value="<?php echo $_SESSION['loginSession']; ?>" class="user-display">
            <!-- Espace de déconnexion : -->
            <a href="delogin-script.php"><input type="submit" value="DECONNEXION" class="btn btn-style-2 ajust-font-size"/></a>
        </div>


    <?php } else if ($activePage === 'login') { ?>

        <a href="index.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>

        <h1 class="text-align-center not-bold">Connectez-vous</h1>

        <div class="display-flex margin-right-1">
            <span class="suggestion">Non inscrit ?</span>
            <!-- Espace d'inscription : -->
            <a href="inscription.php"><input type="submit" value="INSCRIPTION" class="btn btn-style-2"/></a>
        </div>


    <?php } else if ($activePage === 'inscription') { ?>

        <a href="index.php"><img src="img/logo-large.png" alt="Logo Mycave" class="mycave-logo"/></a>

        <h1 class="text-align-center not-bold">Inscrivez-vous !</h1>

        <div class="display-flex margin-right-1">
            <span class="suggestion">Déjà inscrit ?</span>
            <!-- Espace de connexion : -->
            <a href="login.php"><input type="submit" value="CONNEXION" class="btn btn-style-2"/></a>
        </div>


    <?php } ?>

</header>


<body>