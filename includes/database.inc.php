<?php
function connectDatabase()
{
    $username = "root";
    $password = "root";

    try {
        $database = new PDO("mysql:host=localhost;dbname=database", $username, $password);

        return $database;
    } catch (PDOException $error) {
        die("Connection failed: " . $error->getMessage()); // Affiche le message d'erreur
    }
}
?>