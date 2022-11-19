<?php
session_start();
function connectDatabase($databaseName)
{
    $username = "root";
    $password = "root";

    try {
        $database = new PDO("mysql:host=localhost;dbname=$databaseName", $username, $password);

        return $database;
    } catch (PDOException $error) {
        die("Connection failed: " . $error->getMessage()); // Affiche le message d'erreur
    }
}
$database = connectDatabase("database");
?>