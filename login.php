<?PHP
session_start();

require('includes/database.inc.php');
require('includes/session.inc.php');
require('includes/email.inc.php');
require('includes/password.inc.php');
/* -------------------- Redirect to homepage if connected ------------------- */
if (isConnected()) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* ------------------------------- Connection ------------------------------- */
    if (isset($_POST['login-submit'])) {
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        if (!isEmailCorrect($email) || !isPasswordCorrect($password, $email)) {
            $connectionError = "Email ou mot de passe incorrect";

        } else {
            login($email);
            unset($_SESSION['accountCreated']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>" />
    <title>The Power Of Memory</title>
</head>

<body>
    <?php
    include 'view/header.inc.php';
    ?>

    <a href="#login-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="login-banner">
            <h2>CONNEXION</h2>
        </section>

        <section id="login-form">
            <form action="login.php" method="POST">
                <input type="email" name="login-email" id="email" placeholder="Email" required />
                <input type="password" name="login-password" id="password" placeholder="Mot de passe" required />
                <input type="submit" name="login-submit" value="Connexion" />
            </form>
            <?php
            if ($connectionError != null) {
                echo '<p class="form-msg form-error">';
                echo $connectionError;
                echo '</p>';
            } else if ($_SESSION['accountCreated']) {
                echo '<p class="form-msg form-success">Votre compte a été créé avec succès ! Connectez vous.</p>';
            }
            ?>
            <!-- <a href="memory.php"><button>Connexion</button></a> -->

            <p> Pas encore de compte ? <a href="register.php">Créez un compte.</a></p>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php';
    ?>
</body>

</html>