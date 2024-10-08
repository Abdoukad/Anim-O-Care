<?php

class M_comportement
{
    /**
     * Récupère tous les comportements d'un animal.
     *
     * @param int $animal_id
     * @return array|false
     */
    public static function findBehaviorsByAnimalId($animal_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM comportements WHERE animal_id = :animal_id ORDER BY date_enregistrement DESC");
        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau comportement pour un animal.
     *
     * @param int $animal_id
     * @param string $description
     * @param string $type_comportement
     * @return void
     */
    public static function createBehavior($animal_id, $description, $type_comportement)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare('INSERT INTO comportements (animal_id, description, date_enregistrement, type_comportement) VALUES (:animal_id, :description, NOW(), :type_comportement)');
        $stmt->bindParam(':animal_id', $animal_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type_comportement', $type_comportement);
        $stmt->execute();
    }

    /**
     * Récupère les informations d'un comportement par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function findBehaviorById($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM comportements WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un comportement par son ID.
     *
     * @param int $id
     * @return void
     */
    public static function deleteBehavior($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("DELETE FROM comportements WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}
