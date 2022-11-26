<?php
require('includes/database.inc.php');
require('includes/session.inc.php');
require('includes/email.inc.php');
require('includes/password.inc.php');

/* ------------------ Redirect to homepage if not connected ----------------- */
if (!isConnected()) {
    header('Location: index.php');
}
/* -------------------------------------------------------------------------- */
/*                                    Stats                                   */
/* -------------------------------------------------------------------------- */
/* -------------------------------- Position -------------------------------- */
$positionEasy = getPosition("easy", $_SESSION['id']);
$positionNormal = getPosition("normal", $_SESSION['id']);
$positionHard = getPosition("hard", $_SESSION['id']);

/* ---------------------------------- Score --------------------------------- */
$highScoreEasy = getBestTime("easy", $_SESSION['id']);
$highScoreNormal = getBestTime("normal", $_SESSION['id']);
$highScoreHard = getBestTime("hard", $_SESSION['id']);

/* ----------------------------- Number of game ----------------------------- */
$gamePlayedEasy = getNumberOfGames("easy", $_SESSION['id']);
$gamePlayedNormal = getNumberOfGames("normal", $_SESSION['id']);
$gamePlayedHard = getNumberOfGames("hard", $_SESSION['id']);

/* --------------------------- Lowest tries number -------------------------- */
$minTriesEasy = getMinTries("easy", $_SESSION['id']);
$minTriesNormal = getMinTries("normal", $_SESSION['id']);
$minTriesHard = getMinTries("hard", $_SESSION['id']);


/* -------------------------------------------------------------------------- */
/*                             Account management                             */
/* -------------------------------------------------------------------------- */
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
                <img src="assets/images/profiles/<?php echo getProfilePic($_SESSION['id']); ?>"
                    alt="Your profile picture" />
            </div>
            <h3>
                <?php echo $_SESSION['username'] ?>
            </h3>
            <h4>Ma bio :</h4>
            <textarea id="my-bio" maxlength="64" placeholder="Décrivez-vous en quelques mots..."></textarea>
        </section>

        <section id="my-stats">
            <section id="easy">
                <h3 class="difficulty">Facile</h3>
                <div id="stats-list">
                    <article class="stat-display stat1">
                        <h3>
                            <?php echo $positionEasy; ?>
                        </h3>
                        <h4>Position</h4>
                    </article>

                    <article class="stat-display stat2">
                        <h3>
                            <?php echo round($highScoreEasy, 3); ?> sec
                        </h3>
                        <h4>Meilleur Temps</h4>
                    </article>

                    <article class="stat-display stat3">
                        <h3>
                            <?php echo $gamePlayedEasy; ?>
                        </h3>
                        <h4>Parties jouées</h4>
                    </article>

                    <article class="stat-display stat4">
                        <h3>
                            <?php echo $minTriesEasy; ?>
                        </h3>
                        <h4>Record d'essais</h4>
                    </article>
                </div>
            </section>

            <section id="normal">
                <h3 class="difficulty">Normal</h3>
                <div id="stats-list">
                    <article class="stat-display stat1">
                        <h3>
                            <?php echo $positionNormal; ?>
                        </h3>
                        <h4>Position</h4>
                    </article>

                    <article class="stat-display stat2">
                        <h3>
                            <?php echo round($highScoreNormal, 3); ?> sec
                        </h3>
                        <h4>Meilleur Temps</h4>
                    </article>

                    <article class="stat-display stat3">
                        <h3>
                            <?php echo $gamePlayedNormal; ?>
                        </h3>
                        <h4>Parties jouées</h4>
                    </article>

                    <article class="stat-display stat4">
                        <h3>
                            <?php echo $minTriesNormal; ?>
                        </h3>
                        <h4>Record d'essais</h4>
                    </article>
                </div>
            </section>

            <section id="hard">
                <h3 class="difficulty">Difficile</h3>
                <div id="stats-list">
                    <article class="stat-display stat1">
                        <h3>
                            <?php echo $positionHard; ?>
                        </h3>
                        <h4>Position</h4>
                    </article>

                    <article class="stat-display stat2">
                        <h3>
                            <?php echo round($highScoreHard, 3); ?> sec
                        </h3>
                        <h4>Meilleur Temps</h4>
                    </article>

                    <article class="stat-display stat3">
                        <h3>
                            <?php echo $gamePlayedHard; ?>
                        </h3>
                        <h4>Parties jouées</h4>
                    </article>

                    <article class="stat-display stat4">
                        <h3>
                            <?php echo $minTriesHard; ?>
                        </h3>
                        <h4>Record d'essais</h4>
                    </article>
                </div>
            </section>

        </section>

        <section id="my-profile-management">
            <h4>Changer de mail</h4>
            <form action="myaccount.php" method="POST">
                <input type="email" name="new-email" placeholder="Nouveau mail" required />
                <input type="password" name="new-email-password" placeholder="Mot de passe" required />
                <input type="submit" name="new-email-submit" value="Changer d'email" />
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