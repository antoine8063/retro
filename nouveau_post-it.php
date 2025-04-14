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
$req = $db->prepare('SELECT pseudo FROM utilisateur WHERE id = :id');
$req->execute(["id" =>$_SESSION['user_id']]);
$data = $req->fetch();
$pseudo = $data['pseudo'] ?? '';
try {
    $req = $db->prepare('INSERT INTO postit (`expediteur`, `contenu`, `colonne`, `id_tableau`) VALUES (?, ?, ?, ?)');
    $req->execute([$pseudo, $contenu, $colonne, $id]);
    echo json_encode(['status' => 'success', 'message' => 'Post-it ajouté avec succès']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

?>