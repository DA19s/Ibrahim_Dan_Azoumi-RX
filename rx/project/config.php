<?php
    $host = 'localhost';
    $dbname = 'smarttech_db';
    $username = 'root';
    $password = 'Ibou1324';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
?>
