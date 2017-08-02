<div class="display-flex first-axe-center">
    <table class="bottles-table width-70-90 plan-shadow">
            
        <!-- Utilisation de while pour capturer et afficher toutes les lignes : -->
        <?php while ($data = $qry->fetch()) { ?><!-- "execute fetch tant que c'est possible" : donc fetch jusqu'à la dernière ligne : -->
        <tr><!-- les lignes du tableau comportent chacune les colonnes suivantes : -->

            <td><img src="img/<?php echo $data['picture']; ?>" alt="bouteille de vin" class="bottle-img"/></td>     
            <!-- SECURITE : utilisation de la fonction htmlspecialchars pour échapper les balises html qui pourraient avoir été rentrées dans le formulaire -->
            <td><?php echo htmlspecialchars($data['name']); ?></td>
            <td class="plusColumn"><?php echo htmlspecialchars($data['year']); ?></td>
            <td class="plusColumn"><?php echo htmlspecialchars($data['grapes']); ?></td>
            <td class="plusColumn"><?php echo htmlspecialchars($data['country']); ?></td>
            <td>
                <?php if ($activePage === 'index') { ?>

                <!-- boutton "select" pour aller vers bottle-selected-r.php, et on transmet l'id correspondant : -->
                <!-- id-url = (cf.ci-dessous) = id correspondant à la bouteille. C'est ce n° d'id qu'on envoie à la page de destination -->
                <a href="bottle-selected-r.php?id-url=<?php echo $data['id']; ?>"><img src="img/select.png" alt="icône de sélection" class="select-icon"></a>               

                <?php } else if ($activePage === 'user') { ?>

                <!-- idem, mais pour aller vers bottle-selected-rud.php -->
                <a href="bottle-selected-rud.php?id-url=<?php echo $data['id']; ?>"><img src="img/select2.png" alt="icône de sélection" class="select-icon"></a>

                <?php } ?>
            </td>

        </tr>
        <?php } ?>

    </table>
</div>
