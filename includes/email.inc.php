<?php
function verifyEmail($email)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT * FROM `Utilisateur` WHERE Email = :email";
    $request = $database->prepare($sql);
    $request->bindParam("email", $email);
    $request->execute();

    if ($request->rowCount() > 0) {
        return "L'adresse email est déjà utilisée";
    } else {
        return null;
    }
}