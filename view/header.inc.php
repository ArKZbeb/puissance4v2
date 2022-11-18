<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $result = "<li><a href='myaccount.php'>";
    $result .= "<img class='profile-pic' src='assets/images/player.jpg' alt='User icon' />";
    $result .= "</a></li>";
    $result .= "<li><a href='index.php?logout'>";
    $result .= "Se déconnecter";
    $result .= "</a></li>";
} else {
    $result = "<li><a href='login.php'>";
    $result .= "Se connecter";
    $result .= "</a></li>";
    $result .= "<li><a href='register.php'>";
    $result .= "S'inscrire";
    $result .= "</a></li>";
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

<header id="homepage-header">
    <h1>The Power Of Memory</h1>
    <nav>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="register.php">JEU</a></li>
            <li><a href="scores.php">SCORES</a></li>
            <li><a href="contact.php">NOUS CONTACTER</a></li>
            <?php echo $result; ?>
        </ul>
    </nav>
</header>