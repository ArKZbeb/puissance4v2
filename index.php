<?php
require('includes/database.inc.php');
require('includes/session.inc.php');
/* ------------------------------- Live stats ------------------------------- */
$sql = "SELECT * FROM `score`";
$request = $database->query($sql);
$nbrPartie = $request->rowCount();

$sql = "SELECT * FROM `user` WHERE connection_date > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
$request = $database->query($sql);
$nbrOnline = $request->rowCount();

$sql = "SELECT MIN(score) FROM `score`";
$request = $database->query($sql);
$result = $request->fetch();
$highScore = round($result['MIN(score)'], 3);

$sql = "SELECT * FROM `user`";
$request = $database->query($sql);
$NombreUtilisateur = $request->rowCount();

if (isConnected()) {
    $gameLink = "memory.php";
} else {
    $gameLink = "login.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
    <!-- Le style des classes/id créés par PHP ne marche pas sans ?v=<?php echo time(); ?> -->
    <title>The Power Of Memory</title>
</head>

<body>
    <?php
    $includePage = "homepage";
    include 'view/header.inc.php';
    ?>

    <a href="#homepage-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="homepage-banner">
            <h2>BIENVENUE DANS NOTRE STUDIO !</h2>
            <p>Venez challenger les cerveaux les plus agiles !</p>

            <a href="<?php echo $gameLink; ?>"><button id="play-button">JOUER !</button></a>
        </section>

        <section id="intro">
            <div class="images">
                <div class="img1">
                    <img src="assets/images/retro.jpg" alt="Picture of retro devices" />
                </div>

                <div class="img2">
                    <img src="assets/images/dabbing-man.jpg" alt="Picture of retro devices" />
                </div>

                <div class="img3">
                    <img src="assets/images/poker.jpg" alt="Picture of retro devices" />
                </div>
            </div>

            <div class="list-text">
                <article>
                    <h3>01</h3>

                    <div>
                        <h4>Lorem Ipsum</h4>
                        <p>Quisque commodo facilisis purus, interdum volutpat arcu viverra sed. Etiam sodales convallis
                            pretium. Aenean pharetra laoreet lorem. Nunc dapibus tincidunt sem a pharetra. Duis vitae
                            tristique leo, sed faucibus ipsum.</p>
                    </div>
                </article>

                <article>
                    <h3>02</h3>

                    <div>
                        <h4>Lorem Ipsum</h4>
                        <p>Quisque commodo facilisis purus, interdum volutpat arcu viverra sed. Etiam sodales convallis
                            pretium. Aenean pharetra laoreet lorem. Nunc dapibus tincidunt sem a pharetra. Duis vitae
                            tristique leo, sed faucibus ipsum.</p>
                    </div>
                </article>

                <article>
                    <h3>03</h3>

                    <div>
                        <h4>Lorem Ipsum</h4>
                        <p>Quisque commodo facilisis purus, interdum volutpat arcu viverra sed. Etiam sodales convallis
                            pretium. Aenean pharetra laoreet lorem. Nunc dapibus tincidunt sem a pharetra. Duis vitae
                            tristique leo, sed faucibus ipsum.</p>
                    </div>
                </article>

            </div>

        </section>

        <section id="stats">
            <img src="assets/images/wd2.jpg" alt="Cover of the game Watch Dogs 2" />

            <div class="stats-container">
                <div class="stats-row">
                    <article class="stat-display stat1">
                        <h3>
                            <?php echo $nbrPartie ?>
                        </h3>
                        <h4>Parties Jouées</h4>
                    </article>

                    <article class="stat-display stat2">
                        <h3>
                            <?php echo $nbrOnline ?>
                        </h3>
                        <h4>Joueurs connectés</h4>
                    </article>
                </div>

                <div class="stats-row">
                    <article class="stat-display stat3">
                        <h3>
                            <?php echo $highScore ?> sec
                        </h3>
                        <h4>Temps Record</h4>
                    </article>

                    <article class="stat-display stat4">
                        <h3>
                            <?php echo $NombreUtilisateur //variable ?></h3>
                        <h4>Joueurs Inscrits</h4>
                    </article>
                </div>
            </div>

        </section>

        <section id="about-us">
            <h3>Notre Équipe</h3>
            <p>Quisque commodo facilisis purus, interdum volutpat arcu viverra sed.</p>

            <img src="assets/images/ornament.svg" id="ornament" />

            <div class="team">
                <article class="person-display">
                    <img src="assets/images/hamilton.jpg" alt="Picture of Hamilton" />

                    <h4>HAMILTON</h4>
                    <p>Game Developer</p>

                    <div class="social-medias person-social">
                        <a href="https://www.facebook.com" target="_blank"><img src="assets/images/facebook.png"
                                alt="Facebook logo" /></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="assets/images/twitter.png"
                                alt="Twitter logo" /></a>
                        <a href="https://www.pinterest.com" target="_blank"><img src="assets/images/pinterest.png"
                                alt="Pinterest logo" /></a>
                    </div>
                </article>

                <article class="person-display">
                    <img src="assets/images/mickhel.jpg" alt="Picture of Mickhel" />

                    <h4>MICKHEL</h4>
                    <p>Game Designer</p>

                    <div class="social-medias person-social">
                        <a href="https://www.facebook.com" target="_blank"><img src="assets/images/facebook.png"
                                alt="Facebook logo" /></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="assets/images/twitter.png"
                                alt="Twitter logo" /></a>
                        <a href="https://www.pinterest.com" target="_blank"><img src="assets/images/pinterest.png"
                                alt="Pinterest logo" /></a>
                    </div>
                </article>

                <article class="person-display">
                    <img src="assets/images/arnold.jpg" alt="Picture of Arnold" />

                    <h4>ARNOLD</h4>
                    <p>Game Developer</p>

                    <div class="social-medias person-social">
                        <a href="https://www.facebook.com" target="_blank"><img src="assets/images/facebook.png"
                                alt="Facebook logo" /></a>
                        <a href="https://www.twitter.com" target="_blank"><img src="assets/images/twitter.png"
                                alt="Twitter logo" /></a>
                        <a href="https://www.pinterest.com" target="_blank"><img src="assets/images/pinterest.png"
                                alt="Pinterest logo" /></a>
                    </div>
                </article>

            </div>
        </section>

    </main>

    <?php
    include 'view/footer.inc.php';
    ?>
</body>

</html>