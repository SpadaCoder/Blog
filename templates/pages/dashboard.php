<?php $title = "SpadaCoder - Tableau de bord"; ?>

<?php ob_start(); ?>
<section class="container-dashboard">
    <div class="form-dashboard">
    <p class="form-description">Commentaires en attente de validation</p>
        <form method="post" action="">
            <table>
                <thead>
                    <tr>
                        <th>Sélection</th>
                        <th>Commentaire</th>
                        <th>Auteur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsToApprove as $comment): ?>
                        <tr>

                            <td><input type="checkbox" name="comments[]" value="<?php echo $comment->getId(); ?>"></td>
                            <td><?php echo $comment->getContent(); ?></td>
                            <td><?php echo $comment->author; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="dashboard-btn-container">
                <button type="submit" name="action" value="valider">Valider</button>
                <button type="submit" name="action" value="supprimer">Supprimer</button>
            </div>
            </form>
    </div>

    <div class="dashboard-image-container">
        <a href="index.php?objet=post&action=add&role=admin">
            <img src="/../../../public/assets/images/ajout_post.png" alt="Ajouter un post">
            <div>Ajouter un post</div>
        </a>
    </div>
</section>

<?php $content = ob_get_clean();

// Inclure le fichier layout.php.
require 'layout.php';

