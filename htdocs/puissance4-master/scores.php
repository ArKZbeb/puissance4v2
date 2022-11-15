<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href="assets/css/style.css" />
        <title>The Power Of Memory</title>
    </head>
    <body>
        <?php include 'view/header.inc.php' ?>
        <a href="#scores-banner"><button id="fixed-button">⏏</button></a>

        <main>
            <section class="banner" id="scores-banner">
                <h2>CLASSEMENT</h2>
            </section>

            <section id="leaderboard">
                <div id="leaderboard-header">
                    <h4>Profil</h4>
                    <h4>Position</h4>
                    <h4>Temps</h4>
                </div>

                <article class="player-stats-display top1">
                    <img
                        src="assets/images/top1.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>AndréLicorne</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>1</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:10:51</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>

                <article class="player-stats-display top2">
                    <img
                        src="assets/images/top2.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>memorymaster</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>2</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:11:23</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>

                <article class="player-stats-display top3">
                    <img
                        src="assets/images/top3.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>xXBrainSlayerXx</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>3</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:11:47</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>

                <img src="assets/images/ornament.svg" id="ornament" />

                <article class="player-stats-display">
                    <img
                        src="assets/images/fromagelover.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>FromageLover</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>419</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:36:03</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>

                <article class="player-stats-display" id="self-stats">
                    <img
                        src="assets/images/player.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>VOUS</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>420</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:36:24</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>

                <article class="player-stats-display">
                    <img
                        src="assets/images/pierre92.jpg"
                        alt="Player's profile pic"
                    />

                    <div class="player-stats">
                        <div class="stat">
                            <span><h4>Pierre92</h4></span>
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>421</strong>
                                </p></span
                            >
                        </div>
                        <div class="stat">
                            <span
                                ><p class="position">
                                    <strong>00:36:58</strong>
                                </p></span
                            >
                        </div>
                    </div>
                </article>
            </section>
        </main>

        <?php include 'view/footer.inc.php' ?>
    </body>
</html>
