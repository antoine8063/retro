# Retro

Retro est une application web conçue pour faciliter les revues de fin de semaine. Elle permet aux utilisateurs de créer des tableaux de projets, d'ajouter des post-its pour partager ce qui s'est bien ou mal passé, et de gérer leurs informations personnelles.

## Fonctionnalités

- **Gestion des utilisateurs :**
  - Inscription avec validation des mots de passe sécurisés.
  - Connexion avec vérification des identifiants.
  - Modification de l'email et du mot de passe.
  - Téléchargement et affichage d'une photo de profil.

- **Gestion des tableaux :**
  - Création de tableaux par année et projet.
  - Suppression de tableaux existants.

- **Post-its :**
  - Ajout de post-its dans différentes colonnes (ce qui s'est bien/mal passé).
  - Suppression de post-its.
  - Possibilité de poster anonymement.

## Structure du projet



├── index.php # Page de connexion 
├── inscription.php # Page d'inscription 
├── liste_tableau.php # Page listant les tableaux par année et projet 
├── projet.php # Page d'un projet avec les colonnes de post-its 
├── mon_espace.php # Page de gestion des informations personnelles 
├── nouveau_post-it.php # Endpoint pour ajouter un post-it 
├── supprimer_post-it.php # Endpoint pour supprimer un post-it 
├── obtenir_post-it.php # Endpoint pour récupérer les post-its d'un projet 
├── obtenir_annees.php # Endpoint pour récupérer les années des tableaux 
├── obtenir_projets.php # Endpoint pour récupérer les projets d'une année 
├── supp_enr.php # Endpoint pour gérer l'ajout/suppression de tableaux 
├── afficher_image.php # Endpoint pour afficher la photo de profil 
├── utils/ 
│ └── database.php # Fichier de connexion à la base de données 
├── partials/ 
│ └── header.php # En-tête commun aux pages 
├── assets/ 
│ ├── css/ # Fichiers CSS pour le style 
│ │ ├── connexion.css 
│ │ ├── inscription.css 
│ │ ├── liste_tableau.css 
│ │ ├── mon_espace.css 
│ │ └── projet.css 
│ ├── js/ # Fichiers JavaScript pour les interactions 
│ │ ├── liste_tableau.js 
│ │ ├── mon_espace.js 
│ │ └── projet.js 
└── README.md # Documentation du projet