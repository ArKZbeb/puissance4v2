<?php
function connectDatabase()
{
    $username = "root";
    $password = "root";

    try {
        $database = new PDO("mysql:host=localhost;dbname=PowerOfMemory", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $database;
    } catch (PDOException $error) {
        die("Connection failed: " . $error->getMessage());
    }
}
?>