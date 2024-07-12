<header>
    <div class="profile-info">
        <div class="profile-picture">
            <img src="/../../../public/assets/images/profile-picture.jpg" alt="Sandra Spadacini">
        </div>
        <div class="welcome-message">
            <p class="devise">Bienvenue dans le royaume de SpadaCoder, où le code devient une œuvre d'expression et
                les idées prennent vie numériquement.</p>
        </div>
    </div>
</header>

<nav>
    <div class="menu">
        <a href="index.php?" class="menu-item">
            <img src="/../../../public/assets/images/accueil.png" alt="Accueil">
            <div>Accueil</div>
        </a>
        <a href="index.php?action=login" class="menu-item">
            <img src="/../../../public/assets/images/enregistrement.png" alt="Connexion">
            <div>
                <?php if (isset($sessionClean['user']) && $sessionClean['user']): ?>
                    Déconnexion
                <?php else: ?>
                    Connexion
                <?php endif; ?>
            </div>
        </a>
        <?php if (isset($sessionClean['user']) && $sessionClean['user']['role'] === 'admin'): ?>
            <a href="index.php?role=admin&action=approvecomments" class="menu-item">
                <img src="/../../../public/assets/images/admin.png" alt="Tableau de bord">
                <div>Tableau de bord</div>
            </a>
        <?php endif; ?>
    </div>
</nav>
