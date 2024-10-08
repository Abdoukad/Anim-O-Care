<?php

class M_rendezvous
{
    /**
     * Récupère tous les rendez-vous d'un utilisateur.
     *
     * @param int $utilisateur_id
     * @return array|false
     */
    public static function findAppointmentsByUserId($utilisateur_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE utilisateur_id = :utilisateur_id ORDER BY date_heure ASC");
        $stmt->bindParam(":utilisateur_id", $utilisateur_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau rendez-vous pour un animal spécifique.
     *
     * @param int $utilisateur_id
     * @param string $date_heure
     * @param string $veterinaire
     * @param string $description
     * @param int $animaux_id
     * @return void
     */
    public static function createAppointment($utilisateur_id, $date_heure, $veterinaire, $description, $animaux_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare('INSERT INTO rendezvous (utilisateur_id, date_heure, veterinaire, description, animaux_id) VALUES (:utilisateur_id, :date_heure, :veterinaire, :description, :animaux_id)');
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':date_heure', $date_heure);
        $stmt->bindParam(':veterinaire', $veterinaire);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':animaux_id', $animaux_id); // Liaison de l'animal au rendez-vous
        $stmt->execute();
    }

    /**
     * Récupère les informations d'un rendez-vous par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function findAppointmentById($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM rendezvous WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Modifie un rendez-vous.
     *
     * @param int $id
     * @param string $date_heure
     * @param string $veterinaire
     * @param string $description
     * @param int $animaux_id
     * @return void
     */
    public static function updateAppointment($id, $date_heure, $veterinaire, $description, $animaux_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare('UPDATE rendezvous SET date_heure = :date_heure, veterinaire = :veterinaire, description = :description, animaux_id = :animaux_id WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':date_heure', $date_heure);
        $stmt->bindParam(':veterinaire', $veterinaire);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':animaux_id', $animaux_id); // Mise à jour de l'animal associé
        $stmt->execute();
    }

    /**
     * Supprime un rendez-vous par son ID.
     *
     * @param int $id
     * @return void
     */
    public static function deleteAppointment($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("DELETE FROM rendezvous WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}
