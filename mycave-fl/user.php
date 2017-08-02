<?php
session_start();// (attention :  en faisant juste un "var_dump(session_start())", on exécute encore un autre session start ; donc ne pas faire cette commande)

if (isset($_SESSION['idSession']) AND isset($_SESSION['loginSession'])) { ?><!-- SECURITE>> si un utilisateur s'est connecté (et une Session Start a été ouverte) : on permet l'affichage du contenu -->


    <?php $activePage = 'user'; ?><!-- reconnaissance : "je suis sur la page user" -->


    <!-- HEADER -->
    <?php include("header.php"); ?>


    <!-- ***************************
         *    I - MESSAGES à       *
         *      l'utilisateur      *
         *************************** -->
    
    <!-- *** MESSAGES VARIABLES (POP-UP) *** -->
    <?php
    // si effectivement un utilisateur vient de se connecter/loguer ($_GET['loginpost'] transmis) :
    if(isset($_GET['loginpost'])) { ?>

        <div class="pop-up display-flex text-align-center plan-shadow">
            <div data-js="js-in-pop-up" class="in-pop-up width-40-70 margin-auto plan-shadow border-radius-15">

                <p class="margin-top-40 prune-font font-size-1-4 italic">
                <?php echo 'Bienvenue ' . $_GET['loginpost'] . ' !'; ?>
                </p>

                <p>Pour <span class="prune-font bold">mettre à jour</span> ou <span class="prune-font bold">supprimer</span> une bouteille, sélectionnez-là avec l'icône :</p>

                <a href="user.php"><img src="img/select2.png" alt="icône de sélection" class="select-icon"></a><span class="prune-font bold">OK</span>

            </div>
        </div>

    <!-- si pas de $_GET['loginpost'] transmis : ne rien afficher -->
    <?php } ?>

    <?php
    // si message d'erreur transmis sur l'upload du fichier image :
    if(isset($_GET['errorAlert'])) { ?>

        <div class="pop-up display-flex text-align-center plan-shadow">
            <div data-js="js-in-pop-up" class="in-pop-up width-40-70 margin-auto plan-shadow border-radius-15">
                
                <!-- message d'erreur à l'utilisateur : -->
                <p class="margin-top-40 prune-color">Votre bouteille a bien été ajoutée ou mise à jour, mais aucune image n'a pu être enregistrée.</p>
                <p class="margin-bottom-20 prune-color">En effet, <?php echo $_GET['errorAlert']; ?></p>

                <a href="user.php"><input type="submit" value="OK" class="btn btn-style-1"/></a>

            </div>
        </div>

    <!-- si pas de $_GET['errorAlert'] transmis : ne rien afficher -->
    <?php } ?>        


    <?php
    // si message d'info à l'utilisateur : confirmation d'ajout, suppression, ou modif de bouteille :
    if(isset($_GET['msg'])) { ?>

        <div class="pop-up display-flex text-align-center plan-shadow">
            <div data-js="js-in-pop-up" class="in-pop-up width-40-70 margin-auto plan-shadow border-radius-15">

                <p class="margin-top-40 margin-bottom-20 prune-font font-size-1-4 italic">
                <?php echo $_GET['msg']; ?>
                </p>

                <a href="user.php"><input type="submit" value="OK" class="btn margin-top-40 btn-style-1"/></a>

            </div>
        </div>

    <!-- si pas de $_GET['msg'] transmis : ne rien afficher -->
    <?php } ?>


    <!-- *** MESSAGES NON VARIABLES *** -->
    <div class="display-flex first-axe-center">
        
        <div class="display-flex first-axe-center margin-bottom-20 border-radius-15 plan-shadow">

            <div class="text-align-center margin-bottom-20">
                <p><span class="prune-font bold">Ajoutez</span> une nouvelle bouteille à votre cave</p>
                <a href="add-bottle-post.php"><input type="submit" value="AJOUTER" class="btn btn-style-3"/></a>
            </div>

            <div class="width-20 margin-top-40 text-align-center italic"><p>OU</p></div>

            <div class="margin-top-25 text-align-center">
                <p><span class="prune-font bold">Sélectionnez</span> une bouteille pour la <span class="prune-font bold">mettre à jour</span> ou la <span class="prune-font bold">supprimer</span></p>
            </div>

        </div>
        
    </div>


    <!-- CONNEXION à la DATABASE "mycave-db" : -->
    <?php include("connect.php");


    // *************************************
    // *   II - préparation PAGINATION     *
    // *************************************

    // (commentaires complémentaires : cf. index.php)
    // 1> DECOMPTE DU NOMBRE de bouteilles :
    $qry = $mycaveDb->query('SELECT COUNT(id) AS nbBottles FROM mycave');
    $data = $qry->fetch();
    // var_dump($qry);
    // var_dump($data);
    $nbBottles = $data['nbBottles'];

    // 2> détermination du nombre de bouteilles PAR PAGE et du NOMBRE DE PAGES :
    $nbBottlesPerPage = 10;
    $nbPages = ceil($nbBottles/$nbBottlesPerPage);
    // var_dump($nbPages);

    // 3> définition de la CURRENTPAGE :
    if (isset($_GET['page'])) {// j'ai demandé une certaine page depuis ma page précédente
        $currentPage = $_GET['page'];
    } else {// si je n'ai pas de GET page : c'est que je n'ai pas demandé une certaine page depuis ma page précédente : je dois donc arriver sur ma page 1
        $currentPage = 1;
    }
    // var_dump($currentPage);


    // **************************************
    // *   III - AFFICHAGE table "mycave"   *
    // **************************************

    $qry->closeCursor();// libération du curseur pour la requête ci-dessous
    // (commentaires + : cf. index.php)
    $qry = $mycaveDb->query('SELECT id, name, year, grapes, country, picture FROM mycave ORDER BY id DESC LIMIT ' . ($currentPage-1)*$nbBottlesPerPage . ', ' . $nbBottlesPerPage . '');

    // AFFICHAGE :
    ?>
    
    <?php include("bottles-table.php"); ?>


    <!-- *****************************
         *     IV - PAGINATION       *
         ***************************** -->
         
    <?php include("pagination.php"); ?>


    <!-- FOOTER -->
    <?php include("footer.php"); ?>


<?php } else { ?><!-- SECURITE>> si aucune session n'a été ouverte (tentative d'entrer sur la page sans être connecté) -->
    <p>Cette page est réservée aux connectés !</p>
<?php } ?>