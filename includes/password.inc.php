<?php
function verifyPassword($password, $passwordRepeat)
{
    if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z\d]/', $password)) {
        return "Le mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial";

    } else if (strlen($password) < 8) {
        return "Le mot de passe doit faire au moins 8 caractères";

    } else {
        if ($password != $passwordRepeat) {
            return "Les mots de passe ne correspondent pas";
        } else {
            return null;
        }
    }
}

function isPasswordCorrect($password, $email)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT pass FROM `user` WHERE email = :email";
    $request = $database->prepare($sql);
    $request->bindParam("email", $email);
    $request->execute();

    $result = $request->fetch();
    return password_verify($password, $result['pass']);
}
?>