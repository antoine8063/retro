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
<ul id="colonne1"></ul>
pas bien
<div id="ajout_postit">
<input type="text" id="contenu" name="contenu" placeholder="Contenu du post-it">
<button id="ajouter" data-colonne=1>Ajouter</button>
</div>
<ul id="colonne2"></ul>

bien
<div id="ajout_postit">
<input type="text" id="contenu" name="contenu" placeholder="Contenu du post-it">
<button id="ajouter" data-colonne=2>Ajouter</button>
</div>
<script src="assets/js/projet.js"></script>
</body>