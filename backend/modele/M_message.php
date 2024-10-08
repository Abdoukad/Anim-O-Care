<?php

class M_message
{
    /**
     * Enregistre un message de l'utilisateur et la réponse du chatbot dans la base de données.
     *
     * @param int $utilisateur_id
     * @param string $message_utilisateur
     * @param string $message_chatbot
     * @param int $session_id
     * @return void
     */
    public static function saveMessage($utilisateur_id, $message_utilisateur, $message_chatbot, $session_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare('INSERT INTO messages (utilisateur_id, message_utilisateur, message_chatbot, date_enregistrement, session_id) VALUES (:utilisateur_id, :message_utilisateur, :message_chatbot, NOW(), :session_id)');
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        $stmt->bindParam(':message_utilisateur', $message_utilisateur);
        $stmt->bindParam(':message_chatbot', $message_chatbot);
        $stmt->bindParam(':session_id', $session_id);
        $stmt->execute();
    }

    /**
     * Récupère l'historique des messages d'un utilisateur.
     *
     * @param int $utilisateur_id
     * @return array|false
     */
    public static function getMessagesByUserId($utilisateur_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE utilisateur_id = :utilisateur_id ORDER BY date_enregistrement ASC");
        $stmt->bindParam(":utilisateur_id", $utilisateur_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les messages d'une session spécifique.
     *
     * @param int $session_id
     * @return array|false
     */
    public static function getMessagesBySessionId($session_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE session_id = :session_id ORDER BY date_enregistrement ASC");
        $stmt->bindParam(":session_id", $session_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un message par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function getMessageById($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("SELECT * FROM messages WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un message par son ID.
     *
     * @param int $id
     * @return void
     */
    public static function deleteMessage($id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }
}
