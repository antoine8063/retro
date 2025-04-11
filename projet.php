<?php
require_once "utils/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Projet introuvable.";
    exit;
}

$db = db_connect();

$req = $db->prepare("SELECT projet FROM tableau WHERE id = ?");
$req->execute([$id]);
$projet = $req->fetch();

if (!$projet) {
    echo "Aucun projet avec cet ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($projet['projet']) ?></title>
    <script>
        const projet = <?= json_encode($projet['projet']) ?>;
    </script>
    <script src="assets/js/projet.js"></script>
</head>
<ul id="colonne1"></ul>
ce qui est bien
<ul id="colonne2"></ul>
ce qui est pas bien
</body>