<?php
require_once('includes/database.inc.php');
require_once('includes/session.inc.php');
session_start();

/* ---------------------------- Connected or not ---------------------------- */
if (isConnected()) {
    $result = "<li><a href='myaccount.php'>";
<<<<<<< HEAD
<<<<<<< HEAD
    $result .= "<img class='profile-pic' src='assets/images/player.jpg' alt='User icon' />";
    $result .= "</a></li>";
    $result .= "<li><a href='index.php?logout'>";
    $result .= "Se déconnecter";
=======
    $result .= "<img class='header-profile-pic' src='assets/images/player.jpg' alt='User icon'/>";
>>>>>>> c7acb9c6a37f20a9121854a2e97ca19c300f537c
=======
    $result .= "<img class='header-profile-pic' src='assets/images/player.jpg' id='profilpic' alt='User icon'/>";
>>>>>>> 29effcd36d608659c2a0dce1c2abf147301e9375
    $result .= "</a></li>";
    $result .= "<li><a href='?logout'>";
    $result .= "Se déconnecter";
    $result .= "</a></li>";

    $gameLink = "memory.php";
    /* ------------------------ Update last activity time ----------------------- */
    if (isset($database)) {
        updateConnectionDate($_SESSION['id']);
    }

    /* --------------------------------- Log out -------------------------------- */
    if (isset($_GET['logout'])) {
        logout();
    }

} else {
    $result .= "<li><a href='register.php'>";
    $result .= "S'inscrire";
    $result .= "</a></li>";

    $gameLink = "login.php";
}

if (isset($_GET['logout'])) {
    $_SESSION['email'] = $emailpost;
    unset($_SESSION['password']);
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);
    session_destroy();
}
?>

<header <?php if ($includePage=="homepage") echo "id='homepage-header'" ?>
    >
    <h1>The Power Of Memory</h1>
    <nav>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="game.php">JEU</a></li>
            <li><a href="scores.php">SCORES</a></li>
            <li><a href="contact.php">NOUS CONTACTER</a></li>
            <?php echo $result; ?>
        </ul>
    </nav>
</header>

