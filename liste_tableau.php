<head>
  <?php
session_start();
?>
<script src="assets/js/liste_tableau.js"></script>
<link rel="stylesheet" href="assets/css/liste_tableau.css">
<script>
  if (!sessionStorage.getItem('id')) {
    window.location.href = "connexion.php";
  }
</script>
</head>
<body>
<div id="finder">
  <ul id="annees"></ul>
  <ul id="projets"></ul>
</div>
</body>

