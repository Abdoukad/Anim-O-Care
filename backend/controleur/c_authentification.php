<?php

include 'App/modele/M_utilisateur.php';

switch ($action) {

    case 'connexionClient':
        $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        
        if ($email && $password) {
            $client = M_utilisateur::findUserMail($email, $password);

            if ($client) {
                $_SESSION['client'] = $client;
                header('Location:index.php?page=accueil&action=consulter');
                exit; // Arrête l'exécution après la redirection
            } else {
                $_SESSION['erreur'] = 'Veuillez saisir des informations correctes !';
                header('Location:index.php?page=auth&action=connexion');
                exit;
            }
        } else {
            $_SESSION['erreur'] = 'Veuillez saisir un email valide et un mot de passe !';
            header('Location:index.php?page=auth&action=connexion');
            exit;
        }
        break;

    case 'deconnexionClient':
        // Supprime les données de l'utilisateur et d'autres données de session
        unset($_SESSION['client']);
        header('Location:index.php?page=accueil&action=consulter');
        exit;
        break;

    case 'inscriptionClient':
        $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'mdp');
        $nom = filter_input(INPUT_POST, 'nom');
        $prenom = filter_input(INPUT_POST, 'prenom');
        $tel = filter_input(INPUT_POST, 'tel');

        if ($email && $password && $nom && $prenom && $tel) {
            $erreurs = M_utilisateur::createUser($nom, $prenom, $email, $tel, $password);

            if (!$erreurs) {  // Si la création a réussi
                $_SESSION['message'] = 'Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.';
                header('Location:index.php?page=auth&action=connexion');
                exit;
            } else { // S'il y a des erreurs
                $_SESSION['erreur'] = implode('<br>', $erreurs);
                header('Location:index.php?page=auth&action=inscription');
                exit;
            }
        } else {
            $_SESSION['erreur'] = 'Tous les champs sont obligatoires et doivent être valides !';
            header('Location:index.php?page=auth&action=inscription');
            exit;
        }
        break;
}
