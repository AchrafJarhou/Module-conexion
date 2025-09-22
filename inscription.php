<?php
session_start();
require_once './config/config.php';
require_once './config/db.php';
$error = "";





if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST['login'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $nom = $_POST['nom'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($password === $confirm) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$login, $prenom, $nom, $hash]);
        header("Location: connexion.php");
        exit();
    } else {
        $error = "Les mots de passe ne correspondent pas.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inscription</h2>
    <?php if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>
    <form method="post">
        <input type="text" name="login" placeholder="Login" required><br>
        <input type="text" name="prenom" placeholder="Prénom" required><br>
        <input type="text" name="nom" placeholder="Nom" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
