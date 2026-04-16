<?php
require_once 'db.php';

class Activity {
    private $collection;

    public function __construct() {
        $db = Database::connect();
        $this->collection = $db->selectCollection('activities');
    }

    /**
     * 3.4 Création d'une activité par le responsable de club
     */
    public function createActivity($clubId, $titre, $description, $date, $lieu, $places) {
        return $this->collection->insertOne([
            'club_id'     => new MongoDB\BSON\ObjectId($clubId),
            'titre'       => $titre,
            'description' => $description,
            'date'        => $date, // Format YYYY-MM-DD
            'lieu'        => $lieu,
            'nb_places'   => (int)$places,
            'participants' => [], // Liste des IDs des étudiants inscrits
            'status'      => 'active',
            'created_at'  => new MongoDB\BSON\UTCDateTime()
        ]);
    }

    /**
     * 3.4 Inscription d'un étudiant à une activité
     */
    public function registerStudent($activityId, $studentId) {
        // On utilise $addToSet pour éviter les doublons d'inscription
        return $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($activityId)],
            ['$addToSet' => ['participants' => $studentId]]
        );
    }

    /**
     * Récupérer les activités d'un club spécifique
     */
    public function getActivitiesByClub($clubId) {
        return $this->collection->find(['club_id' => new MongoDB\BSON\ObjectId($clubId)])->toArray();
    }

    /**
     * Liste de toutes les activités (Historique et à venir)
     */
    public function getAllActivities() {
        return $this->collection->find([], ['sort' => ['date' => -1]])->toArray();
    }

    /**
     * Supprimer une activité
     */
    public function deleteActivity($activityId) {
        return $this->collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($activityId)]);
    }
}