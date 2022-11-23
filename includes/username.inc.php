<?php
function verifyUsername($username)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT * FROM `user` WHERE username = :user";
    $request = $database->prepare($sql);
    $request->bindParam("user", $username);
    $request->execute();

    if (strlen($username) < 4) {
        return "Le pseudo doit contenir au moins 4 caractères";

    } else if ($request->rowCount() > 0) {
        return "Le pseudo est déjà utilisé";

    } else {
        return null;
    }
}
?>