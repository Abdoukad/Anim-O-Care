<?php

include 'App/modele/M_Utilisateur.php';


switch ($action) {

    case 'connexionClient':
        $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $client = M_utilisateur::findUserMail($email, $password);


        if ($client) {
            $_SESSION['client'] = $client;
            echo 'Vous etes connecté !!';
            header('Location:index.php?page=accueil&action=consulter');
        } else {
            $_SESSION['erreur'] = 'Veuillez saisir des informations correctes !';
        }
        break;

    case 'deconnexionClient':
        supprimerPanier();
        unset($_SESSION['client']);
        header('Location:index.php?page=accueil&action=consulter');
        break;

    case 'inscriptionClient':
        $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'mdp');
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $tel = filter_input(INPUT_POST, 'tel');
        
        header('Location:index.php?page=accueil&action=consulter');

        $client = M_utilisateur::createUser($nom, $prenom,$email, $tel, $password,);
    
        break;
}