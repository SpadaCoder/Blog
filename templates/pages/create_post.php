<?php
// Inclure le fichier header.php
include('header.php'); 
?>

<body class="d-flex flex-column min-vh-100">

<section id="create-post">

    <div class="container">


        <h1>Ajouter un article</h1>
        <form action="index.php?objet=post&action=store" method="POST">
            <div class="title">
                <label for="title" class="form-label">Titre </label>
                <input type="text" class="form-control" id="title" name="title" required><br>
            </div>
            <div class="slug">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required>
            </div>
            <div class="chapo">
                <label for="chapo" class="form-label">Chapo</label>
                <textarea class="form-control" id="chapo" name="chapo" required></textarea>
            </div>
            <div class="content">
                <label for="content" class="form-label">Contenu de l'article</label>
                <textarea class="form-control" id="content" name="content" rows = 5 required></textarea><br>
            </div>
            <div class="picture">
                <label for="picture" class="form-label">Image</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
    </section>
</body>

<?php
// Inclure le fichier header.php
include('footer.php'); 
?>