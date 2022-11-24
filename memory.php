<?php
require('includes/session.inc.php');
/* ------------------ Redirect to homepage if not connected ----------------- */
if (!isConnected()) {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="assets/css/memory.css?v=<?php echo time(); ?>" />
    <title>The Power Of Memory</title>
</head>

<body>
    <?php
    include 'view/header.inc.php';
    ?>

    <a href=" #game-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="game-banner">
            <h2>JEU</h2>
        </section>

        <section id="game-content">
            <button id="start-button">Jouer</button>
            <section class="menu hide">
                <h3 class="timer">00 : 00 : 00 : 000</h3>
                <h3 class="tries-display"><span class="tries-number">0</span> Essais</h3>
            </section>

            <section class="game-board"></section>

            <section class="game-over hide">
                <h2 class="win">Vous avez réussi !</h2>
                <button id="restart-button">Rejouer</button>
                <a href="scores.php">Consulter mon classement</a>
            </section>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>

    <script type="module" src="assets/js/memory.js"></script>
</body>

</html>