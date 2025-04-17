<head>
    <meta charset="UTF-8">
    <title>Mon Espace</title>
    <link rel="stylesheet" href="assets/css/mon_espace.css">
</head>
<body>

<?php

session_start();
require_once "utils/database.php";
$db = db_connect();
include "partials/header.php";
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}
if (isset($_POST['changeemail'])) {
        $ancientemail = htmlspecialchars(trim($_POST['ancientemail']));
        $newemail = htmlspecialchars(trim($_POST['newemail']));
        $mdp = htmlspecialchars($_POST['mdp']);
        $req = $db->prepare('SELECT email,mot_de_passe FROM utilisateur WHERE email = :email');
        $req->execute(array("email" => $_POST['ancientemail']));
        $data = $req->fetch();
        if (!empty($data)){
            if ($data['mot_de_passe'] === $mdp){
                $req = $db->prepare('UPDATE utilisateur SET email = :email WHERE email = :email');
                $req->execute(array("email" => $_POST['ancientemail'],"email" => $_POST['newemail']));
                echo "votre email à été changé";
            }else{
                echo "mauvais mot de passe";
            }
        }else{
            echo "rien n'a été entré";
        }

    }
    if (isset($_POST['changepassword'])) {
        $ancientmdp = htmlspecialchars(trim($_POST['ancientmdp']));
        $newmdp = htmlspecialchars(trim($_POST['newmdp']));
        $newmdph = password_hash($newmdp, PASSWORD_DEFAULT);
        $email = htmlspecialchars($_POST['email']);
        $req = $db->prepare('SELECT email,mot_de_passe FROM utilisateur WHERE email = :email');
        $req->execute(array("email" => $_POST['email']));
        $data = $req->fetch();
        if (!empty($data)){
            if ($data['mot_de_passe'] === $ancientmdp){
                $req = $db->prepare('UPDATE utilisateur SET mot_de_passe = :mot_de_passe WHERE email = :email');
                $req->execute(array("email" => $_POST['email'],"mot_de_passe" => $newmdph));
                echo "votre mot de passe à été changé";
            }else{
                echo "mauvais mot de passe";
            }
        }else{
            echo "rien n'a été rentré";
        }
    }
if (isset($_POST['changerpdp'])) {
    if (isset($_FILES['pdp']) && $_FILES['pdp']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($_FILES['pdp']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            $pdp = file_get_contents($_FILES['pdp']['tmp_name']);
            
            $req = $db->prepare('UPDATE utilisateur SET pdp = :pdp WHERE id = :id');
            $req->execute([
                "id" => $_SESSION['user_id'],
                "pdp" => $pdp
            ]);
            echo "Photo de profil mise à jour avec succès.";
        } else {
            echo "Le fichier doit être une image JPEG ou PNG.";
        }
    } else {
        echo "Erreur lors de l'upload de l'image.";
    }
}





    
    
    ?>

<form method='post' enctype="multipart/form-data">
    <h2 id="pdp">
    <img src="afficher_image.php" alt="Photo de profil" />
    <div class="container"> 
        <input type="file"
        id="pdp"
        name="pdp"
        accept="image/png, image/jpeg" />
    </div>
    <button type="submit" name="changerpdp">changer pdp</button>
    </h2>
    <h3>
    <div class="container"> 
        <input type="email"
        id="ancientemail"
        name="ancientemail"
        placeholder="ancien email" />
    </div>
    <div class="container"> 
        <input type="email"
        id="newemail"
        name="newemail"
        placeholder="nouveau email" />
    </div>
    <div class="container"> 
        <input type="password"
        id="mdp"
        name="mdp"
        placeholder="mot de passe"/>
    </div>
    
    <div class="container">
        <button type="submit" name="changeemail">changer email</button>
    </div>
    </h3>
    <h2>
    <div class="container"> 
        <input type="email"
        id="email"
        name="email"
        placeholder="email" />
    </div>
    <div class="container"> 
        <input type="password"
        id="ancientmdp"
        name="ancientmdp"
        placeholder="ancien mot de passe"/>
        
    </div>
    <div class="container"> 
        <input type="password"
        id="newmdp"
        name="newmdp"
        placeholder="nouveau mot de passe"/>
    </div>
    
    <div class="container">
        <button type="submit" name="changepassword">changer mot de passe</button>
    </div>

    <div class="container">
        <button type="submit" name="deconnexion">se deconnecter</button>
    </div>
    </h2>


</form>

    <?php
    if (isset($_POST['deconnexion'])) {
        session_destroy();
        header('location:connexion.php');
    }
    ?>

</body>