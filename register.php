<?php
require('includes/database.inc.php');
require('includes/session.inc.php');
require('includes/email.inc.php');
require('includes/username.inc.php');
require('includes/password.inc.php');
/* -------------------- Redirect to homepage if connected ------------------- */
if (isConnected()) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* ---------------------------- Create an account --------------------------- */
    if (isset($_POST['register-submit'])) {

        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password-repeat'];

        $accountError = verifyEmail($email);
        if ($accountError == null) {
            $accountError = verifyUsername($username);

            if ($accountError == null) {
                $accountError = verifyPassword($password, $passwordRepeat);

                if ($accountError == null) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    createAccount($email, $username, $hashedPassword);

                    unset($password);
                    unset($passwordRepeat);
                    unset($hashedPassword);
                    $_SESSION['accountCreated'] = true;
                    header('Location: login.php');
                }
            }
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
    include 'view/header.inc.php'
        ?>

    <a href="#signup-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="signup-banner">
            <h2>INSCRIPTION</h2>
        </section>

        <section id="signup-form">
            <form action="register.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required />
                <input type="text" name="username" id="username" placeholder="Pseudo" required />
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />
                <input type="password" name="password-repeat" id="password-repeat"
                    placeholder="Confirmez le mot de passe" required />
                <input type="submit" name="register-submit" value="Inscription" />
            </form>
            <?php
            if ($accountError != null) {
                echo '<p class="form-msg form-error">';
                echo $accountError;
                echo '</p>';
            }
            ?>
            <!-- <a href="login.php"><button>Inscription</button></a> -->

            <p> Déjà un compte ? <a href="login.php">Connectez-vous.</a></p>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>