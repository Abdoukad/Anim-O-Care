
<?php

session_start();

$clientSess = [];

if (!empty($_SESSION['client'])) {
    $clientSess = $_SESSION['client'];
}

// Pour afficher les erreurs PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Attention : A supprimer en production !!!

require("util/fonctions.inc.php");
require('util/validateurs.inc.php');
require("App/modele/AccesDonnees.php");


$uc = filter_input(INPUT_GET, 'uc'); // Use Case
$action = filter_input(INPUT_GET, 'action'); // Action
initPanier();

if (!$uc) {
    $uc = 'accueil';
}

// Controleur principale
switch ($uc) {
    case 'accueil':
        include 'App/controleur/c_consultation.php';
        break;
    case 'visite':
        $type = filter_input(INPUT_GET, "type");
        include 'App/controleur/c_consultation.php';
        break;
    case 'panier':
        include 'App/controleur/c_gestionPanier.php';
        break;
    case 'passerCommande':
        include 'App/controleur/c_passerCommande.php';
        break;
        
    case 'lotterie':
        include 'App/controleur/c_consultation.php';

        break;
    case 'commander':
        $idClient = filter_input(INPUT_GET, 'idClient');
        include 'App/controleur/c_passerCommande.php';
        break;
    case 'administrer':
        include 'App/controleur/c_monCompte.php';
        break;
    case 'article':
        include 'App/controleur/c_consultation.php';
        break;
    case 'authentification':
        include 'App/controleur/c_authentification.php';
        break;
    case 'inscription':
        include 'App/controleur/c_authentification.php';
        break;
    case 'compte':
        include("App/controleur/c_monCompte.php");
        break;
    default:
        break;
}



include("App/vue/template.php");