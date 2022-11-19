<?php
require('includes/database.inc.php');
require('includes/email.inc.php');
require('includes/password.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* ------------------------------ Update email ------------------------------ */
    if (isset($_POST['new-email-submit'])) {
        $newEmail = $_POST['new-email'];
        $password = $_POST['new-email-password'];

        $newEmailError = verifyEmail($newEmail);

        if ($newEmailError == null) {

            if (!isPasswordCorrect($password)) {
                $newEmailError = "Le mot de passe est incorrect";

            } else {
                $sql = "UPDATE `Utilisateur` SET Email = :email WHERE Identi = :id";
                $request = $database->prepare($sql);
                $request->bindParam("email", $newEmail);
                $request->bindParam("id", $_SESSION['id']);
                $request->execute();

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

        if (!isPasswordCorrect($oldPassword)) {
            $newPasswordError = "Votre ancien mot de passe est incorrect";
        } else {
            $newPasswordError = verifyPassword($newPassword, $newPasswordRepeat);

            if ($newPasswordError == null) {
                $sql = "UPDATE `utilisateur` SET Mdp = :newPass WHERE Identi = :id";
                $request = $database->prepare($sql);
                $request->bindParam("newPass", $newPassword);
                $request->bindParam("id", $_SESSION['id']);
                $request->execute();

                $_SESSION['password'] = $newPassword;

                $newPasswordMsg = "Votre mot de passe a été mis à jour avec succès";
            }
        }
    }

    /* ---------------------------- Delete account ---------------------------- */
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
                <input type="password" name="password" placeholder="Mot de passe" required />
                <button type="submit">Supprimer mon compte</button>
            </form>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>