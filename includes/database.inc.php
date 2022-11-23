<?php
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

function updateConnectionDate($accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET connection_date = NOW() WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function createAccount($email, $username, $password)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "INSERT INTO `user` (email, username, pass)
    VALUES (:email, :user, :pass)";
    $request = $database->prepare($sql);
    $request->bindParam("email", $email);
    $request->bindParam("user", $username);
    $request->bindParam("pass", $password);
    $request->execute();
}

function deleteAccount($accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "DELETE FROM `score` WHERE player_id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();

    $sql = "DELETE FROM `user` WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function updateEmail($newEmail, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET email = :email WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("email", $newEmail);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function updatePassword($newPassword, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET pass = :newPass WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("newPass", $newPassword);
    $request->bindParam("id", $accountId);
    $request->execute();
}
?>
