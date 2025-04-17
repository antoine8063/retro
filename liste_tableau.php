<head>
  <?php
session_start();
include "partials/header.php";
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
?>
<script src="assets/js/liste_tableau.js"></script>
<link rel="stylesheet" href="assets/css/liste_tableau.css">
</head>
<body>
<div id="finder">
  <ul id="annees"></ul>
  <ul id="projets"></ul>
</div>
</body>

