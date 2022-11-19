<?php
session_start();

/* ---------------------------- Connected or not ---------------------------- */
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $result = "<li><a href='myaccount.php'>";
    $result .= "<img class='header-profile-pic' src='assets/images/player.jpg' alt='User icon'/>";
    $result .= "</a></li>";
    $result .= "<li><a href='?logout'>";
    $result .= "Se déconnecter";
    $result .= "</a></li>";

    $gameLink = "memory.php";
} else {
    $result = "<li><a href='login.php'>";
    $result .= "Se connecter";
    $result .= "</a></li>";
    $result .= "<li><a href='register.php'>";
    $result .= "S'inscrire";
    $result .= "</a></li>";

    $gameLink = "login.php";
}

/* -------------------------------- Log off --------------------------------- */
if (isset($_GET['logout'])) {
    $_SESSION['email'] = $emailpost;
    unset($_SESSION['password']);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);
    session_destroy();
    header('Location: index.php');
}

/* ------------------------ Update last activity time ----------------------- */
if (isset($database)) {
    $sql = "UPDATE `Utilisateur` SET DateHConnexion = NOW() WHERE Identi = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $_SESSION['id']);
    $request->execute();
}
?>

<header <?php if ($includePage == "homepage")
    echo "id='homepage-header'"; ?>>
    <h1>The Power Of Memory</h1>
    <nav>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="<?php echo $gameLink ?>">JEU</a></li>
            <li><a href="scores.php">SCORES</a></li>
            <li><a href="contact.php">NOUS CONTACTER</a></li>
            <?php echo $result; ?>
        </ul>
    </nav>
</header>