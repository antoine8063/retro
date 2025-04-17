<?php
session_start();
require_once "utils/database.php";
$db = db_connect();

// Récupérer l'image depuis la base de données
$req = $db->prepare('SELECT pdp FROM utilisateur WHERE id = :id');
$req->execute(array("id" => $_SESSION['user_id']));
$data = $req->fetch();

if (!empty($data['pdp'])) {
    // Définir le bon type MIME pour l'image
    header("Content-Type: image/jpeg"); // Changez en "image/png" si nécessaire
    echo $data['pdp'];
} else {
    // Si aucune image n'est trouvée, afficher une image par défaut ou un message
    header("Content-Type: image/png");
    echo file_get_contents('pdpdefaut.png');
}
?>