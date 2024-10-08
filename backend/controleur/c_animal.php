<?php

include 'App/modele/M_animaux.php';

switch ($action) {

    // Affiche le formulaire pour ajouter un nouvel animal
    case 'ajouterAnimal':
        include 'App/vue/ajouter_animal.php';
        break;

    // Enregistre un nouvel animal dans la base de données
    case 'enregistrerAnimal':
        $nom = filter_input(INPUT_POST, 'nom');
        $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
        $race = filter_input(INPUT_POST, 'race');
        $type_animal = filter_input(INPUT_POST, 'type_animal');
        $historique_medical = filter_input(INPUT_POST, 'historique_medical');
        $utilisateur_id = $_SESSION['client']['id'];

        if ($nom && $age && $race && $type_animal) {
            M_animaux::createAnimal($utilisateur_id, $nom, $age, $race, $historique_medical, $type_animal);
            $_SESSION['message'] = 'Animal ajouté avec succès !';
            header('Location:index.php?page=animal&action=listerAnimaux');
            exit;
        } else {
            $_SESSION['erreur'] = 'Tous les champs sont obligatoires.';
            header('Location:index.php?page=animal&action=ajouterAnimal');
            exit;
        }
        break;

    // Liste tous les animaux de l'utilisateur
    case 'listerAnimaux':
        $animaux = M_animaux::findAnimalsByUserId($_SESSION['client']['id']);
        include 'App/vue/lister_animaux.php';
        break;

    // Affiche le formulaire pour modifier un animal
    case 'modifierAnimal':
        $animal_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $animal = M_animaux::findAnimalById($animal_id);

        if ($animal && $animal['utilisateur_id'] == $_SESSION['client']['id']) {
            include 'App/vue/modifier_animal.php';
        } else {
            $_SESSION['erreur'] = 'Animal introuvable ou non autorisé.';
            header('Location:index.php?page=animal&action=listerAnimaux');
            exit;
        }
        break;

    // Enregistre les modifications d'un animal dans la base de données
    case 'enregistrerModificationAnimal':
        $animal_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $nom = filter_input(INPUT_POST, 'nom');
        $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
        $race = filter_input(INPUT_POST, 'race');
        $type_animal = filter_input(INPUT_POST, 'type_animal');
        $historique_medical = filter_input(INPUT_POST, 'historique_medical');

        if ($nom && $age && $race && $type_animal && $animal_id) {
            $resultat = M_animaux::updateAnimal($id, $nom, $age, $race, $historique_medical, $type_animal, $utilisateur_id);

            if ($resultat) {
                $_SESSION['message'] = 'Animal modifié avec succès !';
                header('Location:index.php?page=animal&action=listerAnimaux');
                exit;
            } else {
                $_SESSION['erreur'] = 'Erreur lors de la modification de l\'animal.';
                header("Location:index.php?page=animal&action=modifierAnimal&id={$animal_id}");
                exit;
            }
        } else {
            $_SESSION['erreur'] = 'Tous les champs sont obligatoires.';
            header("Location:index.php?page=animal&action=modifierAnimal&id={$animal_id}");
            exit;
        }
        break;

    // Supprime un animal
    case 'supprimerAnimal':
        $animal_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $resultat = M_animaux::deleteAnimal($animal_id, $_SESSION['client']['id']);

        if ($resultat) {
            $_SESSION['message'] = 'Animal supprimé avec succès !';
        } else {
            $_SESSION['erreur'] = 'Erreur lors de la suppression de l\'animal ou animal non autorisé.';
        }
        header('Location:index.php?page=animal&action=listerAnimaux');
        exit;
        break;

    // Affiche les comportements d'un animal
    case 'consulterComportements':
        $animal_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $comportements = M_animaux::findBehaviorsByAnimalId($animal_id);
        include 'App/vue/consulter_comportements.php';
        break;

    default:
        header('Location:index.php?page=animal&action=listerAnimaux');
        break;
}
