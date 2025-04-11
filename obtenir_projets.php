<?php
require_once "utils/database.php";
$annee = $_GET['annee'] ?? '';
$db = db_connect();
$req = $db->prepare("SELECT projet, id FROM tableau WHERE annee = ?");
$req->execute([$annee]);
$projets = $req->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($projets);
