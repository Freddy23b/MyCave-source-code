<?php
session_start();

if (isset($_SESSION['idSession']) AND isset($_SESSION['loginSession'])) { ?><!-- SECURITE>> si un utilisateur s'est connecté (et une Session Start a été ouverte) : on permet l'affichage du contenu -->


    <?php $activePage = 'update-bottle-post'; ?>


    <!-- insertion header -->
    <?php include("header.php"); ?>


    <?php include("connect.php");
    // affichage debug de la connection à la DB :
    // var_dump($mycaveDb);


    // **********************************************
    // *   I - SELECTION de la bonne bouteille      *
    // *   pour son AFFICHAGE dans le formulaire :  *
    // *     l'utilisateur doit voir ce qu'il       *
    // *            peut/veut modifier              *
    // **********************************************

    // 1) affichage debug de l'id de la bouteille sélectionnée, id pris via l'url :
    // var_dump($_GET['id-url']);

    // 2) Récupération de la bouteille qui a été sélectionnée :
    //préparation :
    $qry = $mycaveDb->prepare("SELECT name, year, grapes, country, region, description, picture FROM mycave WHERE id= ?");
    //exécution :
    //(rappel : $_GET['id_url'] = $data['id'] sur la page où je sélectionne ma bouteille : il s'agit donc bien de l'id ciblé/sélectionné par l'utilisateur)
    $qry->execute(array($_GET['id-url']));
    // Je parcours les données (la ligne) correspondantes à l'id ciblé :
    $data = $qry->fetch();
    // 
    // Affichage debug de la bouteille (ligne) sélectionnée :
    // var_dump($data);
    ?>


    <!-- *****************************************
         *   II - FORMULAIRE avec affichage      *
         *         des données relatives         *
         *        à la bouteille à modifier      *
         *       avec possibilité de rentrer     *
         *         de NOUVELLES DONNEES          *
         ***************************************** -->

    <!-- On peut maintenant afficher les données avec "echo $data['clé de la valeur ciblée'];"-->
    <!-- Pour le "action" de la method post : on transmet bien l'id via l'url : -->
    <!-- (rappel : $_GET['id-url'] <==> $data['id']) -->

    <div class="display-flex first-axe-center">

        <form action="update-bottle-script.php?id-url=<?php echo $_GET['id-url']; ?>" method="post" enctype="multipart/form-data" class="width-70-90 margin-bottom-20"><!-- "enctype" pour pouvoir uploader un fichier image -->
            
            <table class="bottle-selected-table width-100 margin-bottom-20">
                
                <tr><!-- 1 -->
                    <td class="first-column">Image</td>
                    <td class="second-column"><img src="img/<?php echo $data['picture']; ?>" alt="bouteille de vin" class="update-bottle-img"/></td>
                </tr>
                <tr><!-- 8 -->
                    <td><label for="picturePost">Changer l'image<br/>(1 Mo max)</label></td>
                    <td><input type="file" name="picturePost" id="picturePost" placeholder="(pas d'image)"/></td><!-- OpenClassroom : la balise input de type "file" ne peut pas avoir de valeur par défaut. -->
                    <input type="hidden" name="pictureOrigin" id="pictureOrigin" value="<?php echo $data['picture']; ?>"/></td><!-- pour transmettre à la page de destination la valeur $data['picture'] qui se trouve dans la DB : ainsi, si aucun fichier n'est uploadé, on peut demander de reprendre cette même valeur. -->
                </tr>
                <tr><!-- 2 -->
                    <td class="first-column"><label for="namePost">Nom</label></td>
                    <td class="second-column"><input type="text" name="namePost" id="namePost" value="<?php echo $data['name']; ?>" placeholder="(bouteille non nommée)"/></td>
                </tr>
                <tr><!-- 3 -->
                    <td><label for="yearPost">Année</label></td>
                    <td><input type="text" name="yearPost" id="yearPost" value="<?php echo $data['year']; ?>" placeholder="(pas d'année)"/></td>
                </tr>
                <tr><!-- 4 -->
                    <td><label for="grapesPost">Cépage</label></td>
                    <td><input type="text" name="grapesPost" id="grapesPost" value="<?php echo $data['grapes']; ?>" placeholder="(pas de cepage)"/></td>
                </tr>
                <tr><!-- 5 -->
                    <td><label for="countryPost">Pays</label></td>
                    <td><input type="text" name="countryPost" id="countryPost" value="<?php echo $data['country']; ?>" placeholder="(pas de pays)"/></td>
                </tr>
                <tr><!-- 6 -->
                    <td><label for="regionPost">Région</label></td>
                    <td><input type="text" name="regionPost" id="regionPost" value="<?php echo $data['region']; ?>" placeholder="(pas de région)"/></td>
                </tr>
                <tr><!-- 7 -->
                    <td><label for="descriptionPost">Description</label></td>
                    <td><textarea name="descriptionPost" id="descriptionPost" rows="10" placeholder="(pas de description)"><?php echo $data['description']; ?></textarea></td>
                </tr>
                               
            </table>
            
        	<div class="text-align-center"><input type="submit" value="VALIDER" class="btn btn-style-3"/></div>

        </form>
    
    </div>

    <div class="text-align-center margin-bottom-20"><a href="user.php"><input type="submit" value="RETOUR" class="btn btn-style-1"/></a></div>


    <!-- FOOTER -->
    <?php include("footer.php"); ?>


<?php } else { ?><!-- SECURITE>> si aucune session n'a été ouverte (tentative d'entrer sur la page sans être connecté) -->
    <p>Cette page est réservée aux connectés !</p>
<?php } ?>