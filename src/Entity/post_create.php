<body class="d-flex flex-column min-vh-100">
    <div class="container">


        <h1>Ajouter un article</h1>
        <form action="article_post_create.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Titre de l'article</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug">
            </div>
            <div class="mb-3">
                <label for="chapo" class="form-label">Chapo</label>
                <textarea class="form-control" id="chapo" name="chapo"></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Contenu de l'article</label>
                <textarea class="form-control" id="content" name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Image</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</body>