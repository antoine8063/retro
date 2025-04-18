<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/css/inscription.css">
</head>

<body>
    <div class="space-between"></div> <!-- créer un espace -->
    <section class="formulaire">
        <form method="post" action="">
            <div class="container"> 
                <input type="email" id="mail" name="email" placeholder="Email" required>
            </div>
            <div class="container"> 
                <input type="text" id="pseudo" name="pseudo" placeholder="Pseudo" required>
            </div>  
            <div class="container"> 
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
            </div>    

            <div class="niveauMDP">
                <div class="rectangle"></div>
            </div>

            <div class="container"> 
                <input type="password" id="confirmermdp" name="confirmermdp" placeholder="Confirmer mot de passe" required>
            </div>

            <div class="container">
                <button type="submit" name="inscription">S'inscrire</button>
            </div>
        </form>
    </section>

    <div class="space-between"></div> <!-- créer un espace -->

    <?php
        session_start();
        require_once "utils/database.php";
        $db = db_connect();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['inscription'])) {
                $pseudo = htmlspecialchars(trim($_POST['pseudo']));
                $email = htmlspecialchars(trim($_POST['email']));   
                $mdp = htmlspecialchars(trim($_POST['mdp']));
                $confirmermdp = htmlspecialchars(trim($_POST['confirmermdp']));
                $mdph = password_hash($mdp, PASSWORD_DEFAULT);
                if (!empty($pseudo) && !empty($email)) {
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if (strlen($pseudo) > 3) {
                            $req = $db->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo');
                            $req->execute(array("pseudo" => $_POST['pseudo']));
                            $data = $req->fetchAll();
                            if (empty($data)) {
                                $motif = "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
                                if (strlen($mdp) > 8 && $mdp == $confirmermdp && preg_match($motif, $mdp)) {
                                    $req = $db->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, pdp) VALUES(:pseudo, :email, :mot_de_passe, :pdp);");
                                    $req->execute(array(
                                        "pseudo" => $_POST['pseudo'],
                                        "email" => $_POST['email'],
                                        "mot_de_passe" => $mdph,
                                        "pdp" => file_get_contents('pdpdefaut.png')
                                    ));
                                    header("Location: index.php");
                                    exit();
                                } else {
                                    echo "Le mot de passe n'est pas valide";
                                }
                            } else {
                                echo "Le pseudo est déjà pris";
                            }
                        } else {
                            echo "Le pseudo n'est pas valide.";
                        }
                    } else {
                        echo "L'adresse email n'est pas valide.";
                    }
                } else {
                    echo "Tous les champs sont obligatoires.";
                }
            } else {
                echo "Le formulaire n'a pas été soumis correctement.";
            }
        }
    ?>

    <div class="space-between"></div> <!-- créer un espace -->
</body>
</html>