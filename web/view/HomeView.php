<?php ob_start(); ?>
<h1>Home</h1>
    <?php
    if (!empty($tab))
    {
    ?>
    <!-- le tableau prend toute la largeur avec des options -->
    <table class="col-xl-12 table table-dark table-striped">
        <caption>Liste des enseignements</caption>
        <thead>
            <tr>
                    <th scope="col">#</th>
                <?php foreach ($tab[0] as $key => $value) { ?>
                    <th scope="col"><?= $key ?></th>
                <?php } ?>
                    <!-- Cellule vide qui contiendra les symboles (crayon pour modification, etc.) -->
                    <th></th>
                    <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $ligne) { ?>
                <tr>
                        <!-- Debug : voir si on veut utiliser le scope qui pourrait être basé sur l'id-->
                        <th scope="row">X</th>
                    <?php foreach ($ligne as $val) { ?>
                        <td class="casetab">
                            <a href="/web/param/<?= $val ?>"><?= $val ?></a>
                        </td>
                    <?php } ?>
                        <!-- Debug : ajouter les icode pour modification -->
                        <td>
                            <button type="button" class="btn btn-primary">Modifier</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger">Supprimer</button>
                        </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    }
    else
    {
    ?>
        <p>Tableau vide<p>
<?php } ?>

<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
