<?php
require_once 'db.php';

class User {
    private $collection;

    public function __construct() {
        // Connexion à la base de données via ton fichier db.php [cite: 55]
        $db = Database::connect();
        // Création ou accès à la collection 'users' [cite: 57]
        $this->collection = $db->selectCollection('users');
    }

    /**
     * Inscription d'un nouvel utilisateur (Étudiant ou Responsable)
     * Basé sur la section 3.1 du cahier des charges [cite: 23, 24]
     */
    public function register($nom, $email, $password, $filiere, $role = 'etudiant') {
        // Hachage du mot de passe pour la sécurité
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $userData = [
            'nom'        => $nom,       // [cite: 25, 57]
            'email'      => $email,     // [cite: 25, 57]
            'password'   => $hashedPassword,
            'filiere'    => $filiere,   // [cite: 25, 57]
            'role'       => $role,      // etudiant, responsable, ou admin [cite: 59]
            'created_at' => new MongoDB\BSON\UTCDateTime()
        ];

        try {
            return $this->collection->insertOne($userData);
        } catch (Exception $e) {
            return "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }

    /**
     * Connexion (Login)
     * Vérifie si l'utilisateur existe et si le mot de passe est correct [cite: 24]
     */
    public function login($email, $password) {
        $user = $this->collection->findOne(['email' => $email]);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Retourne les infos de l'utilisateur (id, nom, role...)
        }
        return false; // Identifiants incorrects
    }

    /**
     * Récupérer le profil d'un utilisateur
     * Basé sur la section 3.1 [cite: 25]
     */
    public function getProfile($userId) {
        return $this->collection->findOne(['_id' => new MongoDB\BSON\ObjectId($userId)]);
    }

    /**
     * Modifier le profil (Nom, Filière)
     * [cite: 25, 29]
     */
    public function updateProfile($userId, $newData) {
        return $this->collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($userId)],
            ['$set' => $newData]
        );
    }
}