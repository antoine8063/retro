<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>connexion</title>
        <link href="utils/database.php"/>
        <link rel="stylesheet" href="assets/css/connexion.css">
<head>



<body>
    

    <?php
        session_start();
        require_once "utils/database.php";
        $db=db_connect();

        
        if (isset($_POST['connexion'])) {
            $email = htmlspecialchars(trim($_POST['email']));
            $mdp = htmlspecialchars($_POST['mdp']);
            $req = $db->prepare('SELECT id,email,mot_de_passe FROM utilisateur WHERE email = :email');
            $req->execute(array("email" => $_POST['email']));
            $data = $req->fetch();
            if (!empty($data)){
                if ($data['mot_de_passe'] === $mdp){
                    $_SESSION['user_id'] = $data['id'];
                    header('location:connexion.php');
                    echo "c'est bon vous êtes connecté";
                }else{
                    echo "mauvais mot de passe";
                }
            }else{
                echo "le compte n'existe pas";
            }

        }
    ?>

        <div class="space-between"></div> <!-- créer un espace -->
        <form method="post">    
            <section class="formulaire">
                <div class="container"> 
                    <input type="email"
                    id="email"
                    name="email"
                    placeholder="Email" />
                </div>
                <div class=container>
                    <input type="password"
                    id="mdp"
                    name="mdp"
                    placeholder="Mot de passe"/>                
                </div>
                <div class="container">
                    <button type="submit" name="connexion">se connecter</button>
                </div>
                <section class="inscription"> 
                    <a href="inscription.php" >toujours pas connecté ?</a>
                </section>
            </section>
        </form>    
        <div class="space-between"></div> <!-- créer un espace -->
    
</body>

    