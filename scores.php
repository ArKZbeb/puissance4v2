<?php
require('includes/database.inc.php');
require('includes/session.inc.php');
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

    <a href="#scores-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="scores-banner">
            <h2>CLASSEMENT</h2>
        </section>

        <section id="leaderboard">
            <h3 class="difficulty">Facile</h3>
            <?php createLeaderboard("easy", $_SESSION['id']) ?>

            <h3 class="difficulty">Normal</h3>
            <?php createLeaderboard("normal", $_SESSION['id']) ?>

            <h3 class="difficulty">Difficile</h3>
            <?php createLeaderboard("hard", $_SESSION['id']) ?>

        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>