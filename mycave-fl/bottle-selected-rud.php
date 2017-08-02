<?php
session_start();

if (isset($_SESSION['idSession']) AND isset($_SESSION['loginSession'])) { ?><!-- SECURITE>> si un utilisateur s'est connecté (et une Session Start a été ouverte) : on permet l'affichage du contenu -->


    <?php $activePage = 'bottle-selected-rud'; ?>


    <!-- insertion header -->
    <?php include("header.php"); ?>


    <?php include ("connect.php");
    // affichage debug de la connection à la DB :
    // var_dump($mycaveDb);


    // ************************************
    // *    I - RECUPERATION des infos    *
    // *   sur la bouteille sélectionnée  *
    // ************************************

    // 1) affichage debug de l'id de la bouteille sélectionnée, id pris via l'url :
    // var_dump($_GET['id-url']);

    // 2) Récupération de la bouteille qui a été sélectionnée :
    //préparation :
    $qry = $mycaveDb->prepare("SELECT id, name, year, grapes, country, region, description, picture FROM mycave WHERE id= ?");
    //exécution :
    //(rappel : $_GET['id_url'] = $data['id'] sur la page où je sélectionne ma bouteille : il s'agit donc bien de l'id ciblé/sélectionné par l'utilisateur)
    $qry->execute(array($_GET['id-url']));

    // Je parcours les données (la ligne) correspondantes à l'id ciblé :
    $data = $qry->fetch();
    // var_dump($data);
    ?>


    <!-- **************************************
         *   II - CHOIX pour l'utilisateur :  *
         *     SUPPRESSION ou MODIFICATION    *
         ************************************** -->

    <div class="display-flex first-axe-center">

        <div class="display-flex first-axe-center padding-bottom-13 margin-bottom-20 border-radius-15 plan-shadow">

            <div class="text-align-center">
                <p><span class="brdx-font bold">Supprimer</span> cette bouteille</p>

                <input type="submit" value="SUPPRIMER" data-js="js-btn" id="js-btn" class="btn btn-style-3"/><!-- au clic : apparition du bloc de confirmation de suppression ci-dessous -->

                <!-- bloc de confirmation de suppression : -->
                <div data-js="js-confirm-div" id="js-confirm-div" class="confirm-div">
                    <!-- btn envoyant vers le script pour EXECUTER LA SUPPRESSION de la bouteille sélectionnée : -->
                    <!-- (je transmets via l'url l'id de la bouteille sélectionnée ; rappel : $_GET['id-url'] <==> $data['id']) -->
                    <!-- (j'ai aussi besoin de transmettre echo $data['picture']; via pictureName-url, pour également effacer le fichier image de cette bouteille) -->
                    <a href="delete-bottle.php?id-url=<?php echo $_GET['id-url']; ?>&pictureName-url=<?php echo $data['picture']; ?>"><input type="submit" value="CONFIRMER" class="btn btn-style-3"/></a>
                </div>
            </div>

            <div class="width-20 margin-top-40 text-align-center italic"><p>OU</p></div>

            <div class="text-align-center">
                <p><span class="brdx-font bold">Mettre à jour</span> cette bouteille</p>
                    <!-- btn envoyant vers la page de MODIFICATION de la bouteille : -->
                <a href="update-bottle-post.php?id-url=<?php echo $_GET['id-url']; ?>"><input type="submit" value="MODIFIER" class="btn btn-style-3"/></a>
            </div>

        </div>

    </div>


    <!-- ********************************
         *   III - AFFICHAGE de la      *
         *     bouteille sélectionnée   *
         ******************************** -->

    <?php include("bottle-selected-table.php"); ?>

        <div class="text-align-center margin-bottom-20">
            <a href="user.php"><input type="submit" value="RETOUR" class="btn btn-style-1"/></a>
        </div>


    <!-- footer -->
    <?php include("footer.php"); ?>


<?php } else { ?><!-- SECURITE>> si aucune session n'a été ouverte (tentative d'entrer sur la page sans être connecté) -->
    <p>Cette page est réservée aux connectés !</p>
<?php } ?>