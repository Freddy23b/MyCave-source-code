<?php $activePage = 'index'; ?><!-- reconnaissance : "je suis sur la page index" -->


<!-- HEADER -->
<?php include("header.php"); ?>


<div class="adapt-height"><!-- adapter la hauteur au cas où le nombre de bouteilles à afficher est trop faible -->


    <!-- ***************************
         *    I - MESSAGES à       *
         *      l'utilisateur      *
         *************************** -->

    <div class="display-flex first-axe-center">

        <?php
        // si effectivement transmission d'un message de déconnection :
        if(isset($_GET['delogmsg'])) { ?>
            <p class="prune-font font-size-1-4 italic">
            <?php echo $_GET['delogmsg']; ?>
            </p>
        <!-- si pas de msg transmis : ne rien afficher -->
        <?php } ?>

    </div>


    <!-- CONNEXION à la DATABASE "mycave-db" : -->
    <?php include("connect.php");
    // var_dump($mycaveDb);


    // *************************************
    // *  II - préparation PAGINATION      *
    // *************************************

    // 1> DECOMPTE du nombre de bouteilles :
    // Pour compter le nombre de bouteilles (avec "AS" on stock ce nombre dans nbBottles) :
    $qry = $mycaveDb->query('SELECT COUNT(id) AS nbBottles FROM mycave');
    $data = $qry->fetch();
    // var_dump($qry);
    // var_dump($data);// $data est en fait un array avec une clé : "nbBottles", et une valeur lui correspondant, qui est justment le nombre de bouteilles.
    // on cible cette valeur et la rentre en variable :
    $nbBottles = $data['nbBottles'];

    // 2> détermination du nombre de bouteilles par page et du nombre de pages:
    $nbBottlesPerPage = 10;
    $nbPages = ceil($nbBottles/$nbBottlesPerPage);// ceil pour arrondir à l'entier supérieur
    // var_dump($nbPages);

    // 3> définition de la currentPage :
    if (isset($_GET['page'])) {
        $currentPage = $_GET['page'];
    } else {// si l'on n'a pas de GET page : c'est que l'on n'a pas demandé une certaine page depuis notre page précédente : on doit donc arriver sur la page 1
        $currentPage = 1;
    }
    // var_dump($currentPage);


    // *************************************
    // *  III - AFFICHAGE table "mycave"   *
    // *************************************

    // Simple sélection donc "query" suffit.
    // après LIMIT :
    // - ($currentPage-1)*$nbBottlesPerPage représente l'élément à partir duquel je commence ; sur la page 1, cela doit être 0 (l'ordinateur considère que le 1er élément affiché est le 0ème), sur la page 2, cela doit correspondre au nombre total de bouteilles que j'ai par page (ici 10 donc le 10ème pour l'ordinateur), etc. => pour me retrouver sur la bonne bouteille en haut de ma liste.
    // - $nbBottlesPerPage est le nombre d'éléments à afficher par page.
    // Avec DESC, je commence à afficher la bouteille possédant le dernier id ; cela permet d'afficher en premier les dernières bouteilles affichées ; et d'autre part j'en affiche 10 par page (et non 11, attention au sens du "0" !)

    $qry->closeCursor();// libération du curseur pour la requête ci-dessous
    // Si j'adapte "dynamiquement :"
    $qry = $mycaveDb->query('SELECT id, name, year, grapes, country, picture FROM mycave ORDER BY id DESC LIMIT ' . ($currentPage-1)*$nbBottlesPerPage . ', ' . $nbBottlesPerPage . '');

    //$data représente une ligne :
    //$data = $qry2->fetch();// Attention : ceci ne capture que la 1ère ligne
    //var_dump($data);
    ?>
      
    <!-- AFFICHAGE de la table comportant toutes les bouteilles : -->
    <?php include("bottles-table.php"); ?>


    <!-- ******************************
         *     IV - PAGINATION        *
         ****************************** -->
         
    <?php include("pagination.php"); ?>


</div><!-- end div adapt-height -->


<!-- footer -->
<?php include("footer.php"); ?>