<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/connexion.css">
</head>

<body>
    <?php
        session_start();
        require_once "utils/database.php";
        $db = db_connect();

        if (isset($_POST['connexion'])) {
            $email = htmlspecialchars(trim($_POST['email']));
            $mdp = htmlspecialchars($_POST['mdp']);
            $req = $db->prepare('SELECT id, email, mot_de_passe FROM utilisateur WHERE email = :email');
            $req->execute(array("email" => $email));
            $data = $req->fetch();
            if (!empty($data)) {
                if (password_verify($mdp, $data['mot_de_passe'])) {
                    $_SESSION['user_id'] = $data['id'];
                    header('Location: liste_tableau.php');
                    exit;
                } else {
                    echo "Mauvais mot de passe";
                }
            } else {
                echo "Le compte n'existe pas";
            }
        }
    ?>

    <div class="space-between"></div> <!-- créer un espace -->
    <form method="post">    
        <section class="formulaire">
            <div class="container"> 
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="container">
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>                
            </div>
            <div class="container">
                <button type="submit" name="connexion">Se connecter</button>
            </div>
            <section class="inscription"> 
                <a href="inscription.php">Toujours pas connecté ?</a>
            </section>
        </section>
    </form>    
    <div class="space-between"></div> <!-- créer un espace -->
</body>
</html>