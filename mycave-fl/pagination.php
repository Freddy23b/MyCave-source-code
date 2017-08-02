<?php
// Changer la page de destination : page index si on est sur une page index ; page user si on est sur une page user :
if ($activePage === 'index') {
    $linkPage = "index.php";
} else if ($activePage === 'user') {
    $linkPage = "user.php";
}
// echo $linkPage;
?>

<div class="display-flex first-axe-center">
    <ul class="pagination-ul">

        <!-- CHEVRON gauche : lien + effet :-->
        <!-- si je suis sur la page 1, la plus à gauche : ce chevron ne peut renvoyer vers aucun lien, et de plus doit apparaître légèrement, car à ce stade non utile -->        
        <?php if ($currentPage == 1) { ?>
            <li class="opacity"><img src="img/lft-arrow.png" alt="chevron gauche" class="arrow-icon"/></li>
        <!-- si je suis sur une autre page que la 1 : en cliquant sur le chevron gauche, je dois arriver sur ma currentPage - 1 -->
        <?php } else { ?>
            <li><a href="<?php echo $linkPage; ?>?page=<?php echo $currentPage-1; ?>"><img src="img/lft-arrow.png" alt="chevron gauche" class="arrow-icon"/></a></li>
        <?php } ?>

        <!-- PAGES de la pagination : -->
        <!-- ma pagination commence à 1 et doit aller jusqu'à mon nombre de pages : -->
        <?php for ($i=1; $i <= $nbPages ; $i++) {
            
            if ($i == $currentPage) { ?>
                <!-- si le n° de la page de la pagination ($i) correspond à la page sur laquelle je suis : ce n° $i doit apparaître en gras + italique, et ne doit renvoyer nulle part : -->
                <li class="bold italic"><?php echo $i; ?></li>
            <?php } else { ?>
                <!-- sinon ce n° ($i) doit renvoyer vers la page correspondante -->
                <!-- la page indiquée sur laquelle je peux cliquer = la page de destination = $i -->
                <li><a href="<?php echo $linkPage; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>

        <?php } ?><!-- end for -->

        <!-- CHEVRON droit : lien + effet :-->
        <!-- si ma page courrante = nbre total de page : je suis sur la dernière page, la plus à droite : -->
        <!-- cf. chevron gauche ci-dessus -->
        <?php if ($currentPage == $nbPages) { ?>
            <li class="opacity"><img src="img/rgt-arrow.png" alt="chevron droit" class="arrow-icon"/></li>
        <!-- sinon je dois pouvoir aller sur une page suivante : cf. chevron gauche  -->
        <?php } else { ?>
            <li><a href="<?php echo $linkPage; ?>?page=<?php echo $currentPage+1; ?>"><img src="img/rgt-arrow.png" alt="chevron droit" class="arrow-icon"/></a></li>
        <?php } ?>

    </ul>
</div><!-- end pagination-div -->