<?php
session_start();
require_once './config/config.php';
require_once './config/db.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $prenom = $_POST['prenom'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE prenom = ?");
    $stmt->execute([$prenom]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($user);


    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Login ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Connexion</h2>
    <?php if (!empty($error)) {
        echo "<p style='color:red;'>$error</p>";
    } ?>
    <form method="post">
        <input type="text" name="prenom" placeholder="prenom" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
