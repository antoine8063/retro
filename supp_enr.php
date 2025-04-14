<?php
session_start();
require_once "utils/database.php";

$db = db_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'enregistrer') {
        $projet = $_POST['projet'] ?? '';
        $annee = $_POST['annee'] ?? '';
        $req = $db->prepare("INSERT INTO tableau (projet, annee) VALUES (?, ?)");
        $req->execute([$projet, $annee]);
        echo json_encode(['status' => 'success', 'message' => 'Enregistrement réussi']);
    } elseif ($action === 'supprimer') {
        $id = $_POST['id'] ?? '';
        $req = $db->prepare("DELETE FROM tableau WHERE id = ?");
        $req->execute([$id]);
        echo json_encode(['status' => 'success', 'message' => 'Suppression réussie']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Action non reconnue']);
    }
}
?>