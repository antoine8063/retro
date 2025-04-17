<!DOCTYPE HTML>
    <html lang="fr">


    <head>
        <meta charset="utf-8">
        <title>inscription</title>
        <link rel="stylesheet" href="assets/css/inscription.css"/>
        <link href="utils/database.php"/>
    </head>

    <body>


<div class="space-between"></div> <!-- créer un espace -->
    <section class="formulaire">
        <form method="post" action="">
                <div class="container"> 
                    <input type="email"
                    id="mail"
                    name="email"
                    placeholder="Email" require />

                </div>
                <div class="container"> 
                    <input type="text"
                    id="pseudo"
                    name="pseudo"
                    placeholder="Pseudo" require/>
                </div>  
                <div class="container"> 
                    <input type="password"
                    id="mdp"
                    name="mdp"
                    placeholder="Mot De Passe" require/>
                </div>    

                <div class= "niveauMDP">
                    <div class= "rectangle"> 
                        
                    </div>
                </div>

                <div class="container"> 
                    <input type="password"
                    id="confirmermdp"
                    name="confirmermdp"
                    placeholder="Confirmer Mot De Passe" require/>
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
            $db=db_connect();
            // Vérifier si le formulaire a été soumis en vérifiant l'existence du bouton submit
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['inscription'])) {
                    // Valider et assainir les données entrées par l'utilisateur
                    $pseudo = htmlspecialchars(trim($_POST['pseudo']));
                    $email = htmlspecialchars(trim($_POST['email']));   
                    $mdp = htmlspecialchars(trim($_POST['mdp']));
                    $confirmermdp = htmlspecialchars(trim($_POST['confirmermdp']));
                    $mdph = password_hash($mdp, PASSWORD_DEFAULT);
                    // Vérifier que les champs ne sont pas vides
                    if (!empty($pseudo) && !empty($email)) {
                        // Valider l'email
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if (strlen($pseudo) >3){
                                $req = $db->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = :pseudo');
                                $req->execute(array("pseudo" => $_POST['pseudo']));
                                $data = $req->fetchAll();
                                if (empty($data)){
                                    $motif = "/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
                                    if (strlen($mdp)>8  && $mdp==$confirmermdp && preg_match($motif,$mdp)){
                                        // Ici, vous pouvez ajouter le code pour insérer les données dans la base de données ou effectuer d'autres actions
                                        $req = $db->prepare("INSERT INTO utilisateur (pseudo,email,mot_de_passe,pdp) VALUES(:pseudo, :email, :mot_de_passe, :pdp);") ;
                                        $req->execute(array("pseudo" => $_POST['pseudo'],"email" => $_POST['email'],"mot_de_passe" => $mdph,"pdp" => file_get_contents('pdpdefaut.png')));
                                        header("Location: connexion.php");
                                        exit();
                                    }else {
                                        echo "le mot de passe n'est pas valide";
                                    }
                                }else {
                                    echo "le pseudo est déjà pris";
                                }
                
                            }else {
                                echo "le pseudo n'est pas valide.";
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
</hmtl>