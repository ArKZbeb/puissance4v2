<?php
require('includes/database.inc.php');
<<<<<<< HEAD

$database = connectDatabase();
=======
require('includes/session.inc.php');
require('includes/email.inc.php');
require('includes/password.inc.php');

/* ------------------ Redirect to homepage if not connected ----------------- */
if (!isConnected()) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* ------------------------------ Update email ------------------------------ */
    if (isset($_POST['new-email-submit'])) {
        $newEmail = $_POST['new-email'];
        $password = $_POST['new-email-password'];

        $newEmailError = verifyEmail($newEmail);

        if ($newEmailError == null) {

            if (!isPasswordCorrect($password, $_SESSION['email'])) {
                $newEmailError = "Le mot de passe est incorrect";

            } else {
                updateEmail($newEmail, $_SESSION['id']);

                $_SESSION['email'] = $newEmail;
                $newEmailMsg = "L'adresse email de votre compte a été mise à jour avec succès";
            }
        }
    }

    /* ---------------------------- Update password ---------------------------- */
    if (isset($_POST['new-password-submit'])) {
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $newPasswordRepeat = $_POST['new-password-repeat'];

        if (!isPasswordCorrect($oldPassword, $_SESSION['email'])) {
            $newPasswordError = "Votre ancien mot de passe est incorrect";
        } else {
            $newPasswordError = verifyPassword($newPassword, $newPasswordRepeat);

            if ($newPasswordError == null) {
                if ($oldPassword == $newPassword) {
                    $newPasswordError = "Votre nouveau mot de passe doit être différent de l'ancien";

                } else {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    updatePassword($hashedPassword, $_SESSION['id']);

                    $_SESSION['password'] = $newPassword;
                    unset($oldPassword);
                    unset($newPassword);
                    unset($newPasswordRepeat);
                    $newPasswordMsg = "Votre mot de passe a été mis à jour avec succès";
                }
            }
        }
    }

    /* ---------------------------- Delete account ---------------------------- */
    if (isset($_POST['delete-account-submit'])) {
        $password = $_POST['delete-account-password'];

        if (!isPasswordCorrect($password, $_SESSION['email'])) {
            $deleteAccountError = "Le mot de passe est incorrect";

        } else {
            deleteAccount($_SESSION['id']);
            logout();
        }
    }
}
>>>>>>> c7acb9c6a37f20a9121854a2e97ca19c300f537c
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
            <h2>MON ESPACE</h2>
        </section>

        <section id="my-profile">
            <div id="my-profile-pic">
                <img src="assets/images/player.jpg" alt="Your profile picture" />
            </div>
            <h3>
                <?php echo $_SESSION['username'] ?>
            </h3>
            <h4>Ma bio :</h4>
            <textarea id="my-bio" maxlength="64" placeholder="Décrivez-vous en quelques mots..."></textarea>
        </section>

        <section id="my-stats">
            <div id="difficulty-selector">
                <h4>Facile</h4>
                <h4>Normal</h4>
                <h4 id="selected-difficulty">Difficile</h4>
            </div>

            <div id="stats-list">
                <article class="stat-display" id="stat1">
                    <h3>420</h3>
                    <h4>Position</h4>
                </article>

                <article class="stat-display" id="stat2">
                    <h3>69 420</h3>
                    <h4>Meilleur Score</h4>
                </article>

                <article class="stat-display" id="stat3">
                    <h3>14</h3>
                    <h4>Parties jouées</h4>
                </article>

                <article class="stat-display" id="stat4">
                    <h3>9</h3>
                    <h4>Parties gagnées</h4>
                </article>
            </div>
        </section>

        <section id="my-profile-management">
            <h4>Changer de mail</h4>
<<<<<<< HEAD
            <form action="">
                <input type="email" placeholder="Nouveau mail" required />
                <input type="password" placeholder="Mot de passe" required />
                <button type="submit" name="fromage">Changer de mail</button>
=======
            <form action="myaccount.php" method="POST">
                <input type="email" name="new-email" placeholder="Nouveau mail" required />
                <input type="password" name="new-email-password" placeholder="Mot de passe" required />
                <input type="submit" name="new-email-submit" value="Changer d'email" />
>>>>>>> c7acb9c6a37f20a9121854a2e97ca19c300f537c
            </form>
            <?php
            if ($newEmailError != null) {
                echo '<p class="form-msg form-error">';
                echo $newEmailError;
                echo '</p>';
            } else if ($newEmailMsg != null) {
                echo '<p class="form-msg form-success">';
                echo $newEmailMsg;
                echo '</p>';
            }
            ?>

            <h4>Changer de mot de passe</h4>
            <form action="myaccount.php" method="POST">
                <input type="password" name="old-password" placeholder="Ancien mot de passe" required />
                <input type="password" name="new-password" placeholder="Nouveau mot de passe" required />
                <input type="password" name="new-password-repeat" placeholder="Confirmer le nouveau mot de passe"
                    required />
                <input type="submit" name="new-password-submit" value="Changer de mot de passe" />
            </form>
            <?php
            if ($newPasswordError != null) {
                echo '<p class="form-msg form-error">';
                echo $newPasswordError;
                echo '</p>';
            } else if ($newPasswordMsg != null) {
                echo '<p class="form-msg form-success">';
                echo $newPasswordMsg;
                echo '</p>';
            }
            ?>

            <h4>Zone dangereuse</h4>
            <form action="myaccount.php" method="POST">
                <input type="password" name="delete-account-password" placeholder="Mot de passe" required />
                <input id="delete-account-button" type="submit" name="delete-account-submit"
                    value="Supprimer le compte" />
            </form>
            <?php
            if ($deleteAccountError != null) {
                echo '<p class="form-msg form-error">';
                echo $deleteAccountError;
                echo '</p>';
            }
            ?>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>