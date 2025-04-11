<?php
require_once "utils/database.php";
$projet = $_GET['projet'] ?? '';
$colonne = $_GET['colonne'] ?? '';
$db = db_connect();
$req = $db->prepare('SELECT expediteur , contenu 
FROM postit
JOIN tableau ON postit.id_tableau=tableau.id
where tableau.projet = ? AND postit.colonne = ?');
$req->execute([$projet,$colonne]);


$data = $req->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
?>