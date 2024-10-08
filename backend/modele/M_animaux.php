<?php

class M_animal
{
    /**
     * Récupère tous les animaux d'un utilisateur.
     *
     * @param int $utilisateur_id
     * @return array|false
     */
    public static function findAnimalsByUserId($utilisateur_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM animaux WHERE utilisateur_id = :utilisateur_id");
        $stmt->bindParam(":utilisateur_id", $utilisateur_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel animal.
     *
     * @param int $utilisateur_id
     * @param string $nom
     * @param int $age
     * @param string $race
     * @param string $historique_medical
     * @param string $type_animal
     * @return void
     */
    public static function createAnimal($utilisateur_id, $nom, $age, $race, $historique_medical, $type_animal)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare('INSERT INTO animaux (utilisateur_id, nom, age, race, historique_medical, date_ajout, type_animal) VALUES (:utilisateur_id, :nom, :age, :race, :historique_medical, NOW(), :type_animal)');
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':race', $race);
        $stmt->bindParam(':historique_medical', $historique_medical);
        $stmt->bindParam(':type_animal', $type_animal);
        $stmt->execute();
    }

    /**
     * Récupère les informations d'un animal par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function findAnimalById($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM animaux WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les comportements d'un animal.
     *
     * @param int $animal_id
     * @return array|false
     */
    public static function findBehaviorsByAnimalId($animal_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM comportements WHERE animal_id = :animal_id");
        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
