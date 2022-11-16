<?php
function connectDatabase()
{
    $username = "root";
    $password = "root";
    $database = new PDO("mysql:host=localhost;dbname=PowerOfMemory", $username, $password);

    try {
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $error) {
        echo "Connection failed: " . $error->getMessage();
    }

    return $database;
}
?>