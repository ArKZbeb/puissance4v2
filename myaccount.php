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
            <form action="">
                <input type="email" placeholder="Nouveau mail" required />
                <input type="password" placeholder="Mot de passe" required />
                <button type="submit">Changer de mail</button>
            </form>

            <h4>Changer de mot de passe</h4>
            <form action="profile.html" method="POST">
                <input type="password" name="old-password" placeholder="Ancien mot de passe" required />
                <input type="password" name="new-password" placeholder="Nouveau mot de passe" required />
                <input type="password" name="new-password-confirm" placeholder="Confirmer le nouveau mot de passe"
                    required />
                <button type="submit">Changer de mot de passe</button>
            </form>

            <h4>Zone dangereuse</h4>
            <form action="profile.html" method="POST">
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