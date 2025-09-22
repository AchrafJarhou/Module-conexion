<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue sur mon site</h1>
    <nav>
        <a href="inscription.php">Inscription</a> | 
        <a href="connexion.php">Connexion</a> |
        <?php if (isset($_SESSION['login'])): ?>
            <a href="profil.php">Profil</a> | 
            <?php if ($_SESSION['login'] === 'admin'): ?>
                <a href="admin.php">Admin</a> |
            <?php endif; ?>
            <a href="logout.php">Déconnexion</a>
        <?php endif; ?>
    </nav>
</body>
</html>
