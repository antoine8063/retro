<?php
session_start();
require_once "utils/database.php";
$db = db_connect();
$id = $_SESSION['id'] ?? '';
$colonne = $_GET['colonne'] ?? '';
$contenu = $_GET['contenu'] ?? '';
if (empty($colonne) || empty($contenu)) {
    echo json_encode(['status' => 'error', 'message' => 'Colonne ou contenu manquant']);
    exit;
}

try {
    $req = $db->prepare('INSERT INTO postit (`expediteur`, `contenu`, `colonne`, `id_tableau`) VALUES (?, ?, ?, ?)');
    $req->execute([$_SESSION['user_id'], $contenu, $colonne, $id]);
    echo json_encode(['status' => 'success', 'message' => 'Post-it ajouté avec succès']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

