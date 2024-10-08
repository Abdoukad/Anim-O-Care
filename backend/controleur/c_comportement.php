<?php

class C_comportement
{
    /**
     * Récupère tous les comportements d'un animal.
     *
     * @param int $animal_id
     * @return array|false
     */
    public function getBehaviorsByAnimal($animal_id)
    {
        return M_comportement::findBehaviorsByAnimalId($animal_id);
    }

    /**
     * Crée un nouveau comportement pour un animal.
     *
     * @param int $animal_id
     * @param string $description
     * @return void
     */
    public function addBehavior($animal_id, $description)
    {
        if (!empty($description)) {
            M_comportement::createBehavior($animal_id, $description);
        } else {
            throw new Exception("La description ne peut pas être vide.");
        }
    }

    /**
     * Récupère les informations d'un comportement par son ID.
     *
     * @param int $id
     * @return array|false
     */
    public function getBehaviorById($id)
    {
        return M_comportement::findBehaviorById($id);
    }

    /**
     * Supprime un comportement par son ID.
     *
     * @param int $id
     * @return void
     */
    public function deleteBehavior($id)
    {
        M_comportement::deleteBehavior($id);
    }

    /**
     * Met à jour un comportement existant.
     *
     * @param int $id
     * @param int $animal_id
     * @param string $description
     * @return void
     */
    public function updateBehavior($id, $animal_id, $description)
    {
        if (!empty($description)) {
            M_comportement::updateBehavior($id, $animal_id, $description);
        } else {
            throw new Exception("La description ne peut pas être vide.");
        }
    }
}
