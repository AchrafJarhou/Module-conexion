<?php
session_start();
require_once './config/config.php';
require_once './config/db.php';


if (!isset($_SESSION['login']) || $_SESSION['login'] !== "admin") {
    header("Location: index.php");
    exit();
}

$result = $pdo->query("SELECT * FROM utilisateurs");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Gestion des utilisateurs</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th><th>Login</th><th>Prénom</th><th>Nom</th><th>Password (hash)</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
            <!-- <?php var_dump($row); ?> -->
            
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['login']) ?></td>
                <td><?= htmlspecialchars($row['prenom']) ?></td>
                <td><?= htmlspecialchars($row['nom']) ?></td>
                <td><?= htmlspecialchars($row['password']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
