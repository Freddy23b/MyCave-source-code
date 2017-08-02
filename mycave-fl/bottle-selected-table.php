<div class="display-flex first-axe-center margin-bottom-20">
    <table class="bottle-selected-table width-70-90 plan-shadow">
        <!-- Je peux maintenant afficher mes données avec "echo $data['clé valeur ciblée'];" : -->
        <tr>
            <td class="first-column bold">Image</td>
            <td class="second-column"><img src="img/<?php echo $data['picture']; ?>" alt="bouteille de vin" class="bottle-img"/></td>
        </tr>
        <tr>
            <td class="bold">Nom</td>
            <!-- SECURITE : utilisation de la fonction htmlspecialchars pour échapper les balises html qui pourraient avoir été rentrées dans le formulaire -->
            <td><?php echo htmlspecialchars($data['name']); ?></td>
        </tr>
        <tr>
            <td class="bold">Année</td>
            <td><?php echo htmlspecialchars($data['year']); ?></td>
        </tr>
        <tr>
            <td class="bold">Cépage</td>
            <td><?php echo htmlspecialchars($data['grapes']); ?></td>
        </tr>
        <tr>
            <td class="bold">Pays</td>
            <td><?php echo htmlspecialchars($data['country']); ?></td>
        </tr>
        <tr>
            <td class="bold">Région</td>
            <td><?php echo htmlspecialchars($data['region']); ?></td>
        </tr>
        <tr>
            <td class="bold">Description</td>
            <td><?php echo htmlspecialchars($data['description']); ?></td>
        </tr>
    </table>
</div><!-- end table-div -->
