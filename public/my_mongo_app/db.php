
<?php
require 'vendor/autoload.php'; 

class Database {
    public static function connect() {
        try {
            
            $client = new MongoDB\Client("mongodb://localhost:27017"); 
            return $client->selectDatabase('club_db'); // Smiya dyal DB dyalkom
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}