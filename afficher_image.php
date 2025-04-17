<?php
session_start();
require_once "utils/database.php";
$db = db_connect();

// Récupérer l'image depuis la base de données
$req = $db->prepare('SELECT pdp FROM utilisateur WHERE id = :id');
$req->execute(array("id" => $_SESSION['user_id']));
$data = $req->fetch();

if (!empty($data['pdp'])) {
    header("Content-Type: image/jpeg"); 
    echo $data['pdp'];
} else {
    header("Content-Type: image/png");
    echo file_get_contents('pdpdefaut.png');
}
?>