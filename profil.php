<?php
session_start();
require_once './config/config.php';
require_once './config/db.php';


if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

$id = $_SESSION['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET login=?, prenom=?, nom=?, password=? WHERE id=?");
        $stmt->execute([$login, $prenom, $nom, $hash, $id]);
    } else {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET login=?, prenom=?, nom=? WHERE id=?");
        $stmt->execute([$login, $prenom, $nom, $id]);
    }

    $_SESSION['login'] = $login;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['nom'] = $nom;
    $message = "Profil mis à jour avec succès.";
}

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Mon profil</h2>
    <?php if (!empty($message)) {
        echo "<p style='color:green;'>$message</p>";
    } ?>
    <form method="post">
        <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required><br>
        <input type="text" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required><br>
        <input type="text" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required><br>
        <input type="password" name="password" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)"><br>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
