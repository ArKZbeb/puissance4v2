<?php
require('includes/database.inc.php');
require('includes/session.inc.php');
/* ------------------ Redirect to homepage if not connected ----------------- */
if (!isConnected()) {
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['score'])) {
        $sql = "INSERT INTO `score` (`player_id`, `difficulty`, `score`, `tries`) VALUES (:playerId, :diff, :score, :tries)";
        $request = $database->prepare($sql);
        $request->bindParam("playerId", $_SESSION['id']);
        $request->bindParam("diff", $_POST['difficulty']);
        $request->bindParam("score", $_POST['score']);
        $request->bindParam("tries", $_POST['tries']);
        $request->execute();
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
            <form class="select-options">
                <select name="theme" id="theme">
                    <option value="pokemon" id="pokemon">Pokémon</option>
                    <option value="league" id="league">League of Legends</option>
                    <option value="memes" id="memes">Memes</option>
                </select>
                <select name="difficulty" id="difficulty">
                    <option value="easy" id="easy">Facile</option>
                    <option value="normal" id="normal">Normal</option>
                    <option value="hard" id="hard">Difficile</option>
                </select>
            </form>


            <section class="menu hide">
                <h3 class="timer">00 : 00 : 000</h3>
                <h3 class="tries-display"><span class="tries-number">0</span> Essais</h3>
            </section>

            <section class="game-board hide"></section>

            <section class="game-over hide">
                <h2 class="win">Vous avez réussi !</h2>
                <a href="memory.php"><button id="restart-button">Rejouer</button></a>
                <a href="scores.php">Consulter mon classement</a>
            </section>
        </section>
    </main>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="assets/js/memory.js"></script>
</body>

</html>