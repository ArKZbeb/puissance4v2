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
    <title>The Power Of Memory</title>
</head>

<body>
    <?php
    include 'view/header.inc.php';
    ?>

    <a href="#game-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="game-banner">
            <h2>JEU</h2>
        </section>

        <section class="game-window">
            <div class="game-card">
                <div class="card-front">
                    <img src="assets/images/cards/.jpg" alt="image" />
                </div>
                <div class="card-back">
                    <img src="assets/images/cards/.jpg" alt="image" />
                </div>
            </div>
        </section>

    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>