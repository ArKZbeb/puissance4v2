<?php
session_start();

function isConnected()
{
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
}

function login($email)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php'

    $sql = "SELECT * FROM `user` WHERE email = :mail";
    $request = $database->prepare($sql);
    $request->bindParam("mail", $email);
    $request->execute();

    $result = $request->fetch();

    $_SESSION['id'] = $result['id'];
    $_SESSION['username'] = $result['username'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['loggedin'] = true;
    header('Location: index.php');
    exit();
}

function logout()
{
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['loggedin']);
    session_destroy();
    header('Location: index.php');
    exit();
}
?>