<?php
require_once 'db.php';

class Club {
    private $collection;

    public function __construct() {
        // Connexion à la base via db.php
        $db = Database::connect();
        // Accès à la collection 'clubs'
        $this->collection = $db->selectCollection('clubs');
    }

    /**
     * 3.2 Création d’un club (par un Responsable)
     */
    public function createClub($nom, $description, $logo, $idResponsable) {
        return $this->collection->insertOne([
            'nom'            => $nom,
            'description'    => $description,
            'logo'           => $logo, // Nom du fichier image
            'responsable_id' => $idResponsable, 
            'status'         => 'en_attente', // Par défaut, doit être validé par l'admin
            'date_creation'  => new MongoDB\BSON\UTCDateTime()
        ]);
    }

    /**
     * 3.2 Validation du club par l’administrateur
     */
    public function validateClub($clubId) {
        return $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($clubId)],
            ['$set' => ['status' => 'validé']]
        );
    }

    /**
     * 3.2 Consultation de la liste des clubs validés (pour les Étudiants)
     */
    public function getActiveClubs() {
        return $this->collection->find(['status' => 'validé'])->toArray();
    }

    /**
     * Récupérer tous les clubs (pour l'Admin)
     */
    public function getAllClubs() {
        return $this->collection->find([])->toArray();
    }

    /**
     * Modifier les informations d'un club
     */
    public function updateClub($clubId, $newData) {
        return $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($clubId)],
            ['$set' => $newData]
        );
    }

    /**
     * 3.2 Suppression d'un club
     */
    public function deleteClub($clubId) {
        return $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($clubId)]);
    }

    /**
     * Trouver un club par son ID
     */
    public function getClubById($clubId) {
        return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($clubId)]);
    }
}