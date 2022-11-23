<?php
function verifyEmail($email)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "L'adresse email n'est pas valide";

    } else {
        list($name, $mailDomain) = explode("@", $email);
        if (!checkdnsrr($mailDomain, "MX")) {
            return "Le domaine de l'adresse email n'existe pas";

        } else {
            $sql = "SELECT * FROM `user` WHERE email = :email";
            $request = $database->prepare($sql);
            $request->bindParam("email", $email);
            $request->execute();

            if ($request->rowCount() > 0) {
                return "L'adresse email est déjà utilisée";
            } else {
                return null;
            }
        }
    }
}

function isEmailCorrect($email)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT * FROM `user` WHERE email = :email";
    $request = $database->prepare($sql);
    $request->bindParam("email", $email);
    $request->execute();

    return $request->rowCount() > 0;
}
?>