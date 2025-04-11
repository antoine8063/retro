<head>
<script src="assets/js/liste_tableau.js"></script>
<link rel="stylesheet" href="assets/css/liste_tableau.css">
</head>
<body>
<div id="finder">
  <ul id="annees"></ul>
  <ul id="projets"></ul>
</div>
<?php
session_start();
require_once "utils/database.php";
$annee = $_GET['annee'] ?? '';
$id = $_POST['id'] ?? '';
$db = db_connect();
if (isset($_POST['enregistrer'])) {
  $req = $db->prepare("INSERT into tableau (projet, annee) VALUES (?, ?)");
  $req->execute([$_POST['projet'], $_POST['annee']]);   
}
if (isset($_POST['supprimer'])) {
  $req = $db->prepare("DELETE FROM tableau WHERE id = ?"); 
  $req->execute([$id]); 
}
?>

</body>

