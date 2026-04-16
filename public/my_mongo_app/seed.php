<?php
require_once 'Club.php';
$clubModel = new Club();

// Test: Zidi club dyal l-Informatique
$clubModel->createClub(
    "Club IT", 
    "Club dyal l-codage w l-IA", 
    "logo_it.png", 
    "ID_DIAL_AYA"
);
echo "✅ Club test t-zad!";