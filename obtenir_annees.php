<?php
require_once "utils/database.php";
$db = db_connect();
$req = $db->prepare('SELECT distinct annee FROM tableau');
$req->execute();
$annees = $req->fetchAll(PDO::FETCH_COLUMN); 
echo json_encode($annees);
