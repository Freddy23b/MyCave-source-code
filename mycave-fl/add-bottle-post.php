<?php
session_start();

if (isset($_SESSION['idSession']) AND isset($_SESSION['loginSession'])) { ?><!-- SECURITE>> si un utilisateur s'est connecté (et une Session Start a été ouverte) : on permet l'affichage du contenu -->


    <?php $activePage = 'add-bottle-post'; ?>


    <!-- insertion header -->
    <?php include("header.php"); ?>


    <!-- ************************************
         *    I - FORMULAIRE : ajout        *
         *          d'une bouteille         *
         ************************************ -->

    <div class="display-flex first-axe-center">
        <form action="add-bottle-script.php" method="post" enctype="multipart/form-data" class="width-70-90 margin-bottom-20"><!-- "enctype" pour pouvoir uploader un fichier image -->
            
            <table class="bottle-selected-table width-100 margin-bottom-20">
                <tr>
                    <td class="first-column"><label for="namePost">Nom*</label></td>
                    <td class="second-column"><input type="text" name="namePost" id="namePost" placeholder="Nom" required/></td>
                </tr>
                <tr>
                    <td><label for="yearPost">Année*</label></td>
                    <td><input type="text" name="yearPost" id="yearPost" placeholder="Année" required/></td>
                </tr>
                <tr>
                    <td><label for="grapesPost">Cépage*</label></td>
                    <td><input type="text" name="grapesPost" id="grapesPost" placeholder="Cépage" required/></td>
                </tr>
                <tr>
                    <td><label for="countryPost">Pays</label></td>
                    <td><input type="text" name="countryPost" id="countryPost" placeholder="Pays"/></td>
                </tr>
                <tr>
                    <td><label for="regionPost">Région</label></td>
                    <td><input type="text" name="regionPost" id="regionPost" placeholder="Région"/></td>
                </tr>
                <tr>
                    <td><label for="descriptionPost">Description</label></td>
                    <td><textarea name="descriptionPost" id="descriptionPost" rows="10" placeholder="Description"></textarea></td>
                </tr>
                <tr>
                    <td><label for="picturePost">Image<br/>(1 Mo max)</label></td>
                    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />pour limiter la taille de mon fichier à 1Mo soit 1000000 o soit 1048576 o suivant l'ancien système -->
                    <td><input type="file" name="picturePost" id="picturePost" placeholder="Image"/></td><!-- fichier image : donc type file -->
                </tr>
            </table>
            
            <div class="text-align-center"><input type="submit" value="AJOUTER" class="btn btn-style-3"/></div>

        </form>
    </div>
                
    <div class="text-align-center margin-bottom-20"><a href="user.php"><input type="submit" value="RETOUR" class="btn btn-style-1"/></a></div>


    <!-- footer -->
    <?php include("footer.php"); ?>


<?php } else { ?><!-- SECURITE>> si aucune session n'a été ouverte (tentative d'entrer sur la page sans être connecté) -->
    <p>Cette page est réservée aux connectés !</p>
<?php } ?>