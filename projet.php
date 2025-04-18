<?php
session_start();
include "partials/header.php";
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
require_once "utils/database.php";
$id = $_GET['id'] ?? null;
$_SESSION['id'] = $id;
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
    <link rel="stylesheet" href="assets/css/projet.css">
</head>
<body>
<div id="tableau">
    <!-- Colonne 1 -->
    <div class="colonne1">
        <div class="colonne-title">Ce qu'il c'est bien passé</div>
        <ul id="colonne1"></ul>
    </div>

    <!-- Colonne 2 -->
    <div class="colonne2">
        <div class="colonne-title">Ce qu'il c'est mal passé</div>
        <ul id="colonne2"></ul>
    </div>
</div>

<!-- Formulaire d'ajout -->
<div id="ajout_postit">
    <select id="colonne" name="colonne">
        <option value="1">Colonne 1</option>
        <option value="2">Colonne 2</option>
    </select>
    <input type="checkbox" id="anonyme" name="anonyme" value="anonyme"> anonyme
    <input type="text" id="contenu" name="contenu" placeholder="Contenu du post-it">
    <button id="ajouter">Ajouter</button>
</div>
<script src="assets/js/projet.js"></script>
</body>
</html>