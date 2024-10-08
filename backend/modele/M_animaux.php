    <?php

    class M_animaux
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

        /**
         * Crée un nouveau comportement.
         *
         * @param int $animal_id
         * @param string $nom  */

        public static function deleteAnimal($id, $utilisateur_id)
        {
            $pdo = AccesDonnees::getPdo();
        
            // Commence une transaction pour s'assurer que les deux suppressions sont atomiques
            $pdo->beginTransaction();
        
            try {
                // Supprime les comportements associés à l'animal
                $stmt = $pdo->prepare("DELETE FROM comportements WHERE animal_id = :animal_id");
                $stmt->bindParam(":animal_id", $id);
                $stmt->execute();
        
                // Supprime l'animal
                $stmt = $pdo->prepare("DELETE FROM animaux WHERE id = :id AND utilisateur_id = :utilisateur_id");
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":utilisateur_id", $utilisateur_id);
                $stmt->execute();
        
                // Valide la transaction
                $pdo->commit();
                return true;
            } catch (Exception $e) {
                // Annule la transaction en cas d'erreur
                $pdo->rollBack();
                return false;
            }
        }
        

    /**
     * Modifie les informations d'un animal.
     *
     * @param int $id
     * @param string $nom
     * @param int $age
     * @param string $race
     * @param string $historique_medical
     * @param string $type_animal
     * @param int $utilisateur_id
     * @return bool
     */
    public static function updateAnimal($id, $nom, $age, $race, $historique_medical, $type_animal, $utilisateur_id)
    {
        $pdo = AccesDonnees::getPdo();
        $stmt = $pdo->prepare("UPDATE animaux SET nom = :nom, age = :age, race = :race, historique_medical = :historique_medical, type_animal = :type_animal WHERE id = :id AND utilisateur_id = :utilisateur_id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':race', $race);
        $stmt->bindParam(':historique_medical', $historique_medical);
        $stmt->bindParam(':type_animal', $type_animal);
        $stmt->bindParam(':utilisateur_id', $utilisateur_id);
        return $stmt->execute();
    }
    }
