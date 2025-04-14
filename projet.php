<?php
session_start();
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
</head>
<body>
<ul id="colonne1"></ul>
pas bien

<ul id="colonne2"></ul>
bien
<div id="ajout_postit">
    <select id="colonne" name="colonne">
        <option value=1>Colonne 1</option>
        <option value=2>Colonne 2</option>
    </select>
    <input type="checkbox" id="anonyme" name="anonyme" value="anonyme"> anonyme
    <input type="text" id="contenu" name="contenu" placeholder="Contenu du post-it">
    <button id="ajouter" >Ajouter</button>
</div>
<script src="assets/js/projet.js"></script>
</body>