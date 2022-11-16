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
    <?php
    include 'view/header.inc.php'
        ?>

    <a href="#contact-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="contact-banner">
            <h2>NOUS CONTACTER</h2>
        </section>

        <section id="contact-info">
            <a href="tel: +33605040302">
                <article class="contact-info-display">
                    <div class="image-container">
                        <img src="assets/images/phone.png" alt="Icon of a smartphone" />
                    </div>
                    <p>06 05 04 03 02</p>
                </article>
            </a>

            <a href="mailto: support@powerofmemory">
                <article class="contact-info-display">
                    <div class="image-container">
                        <img src="assets/images/mail.png" alt="Icon of an enveloppe" />
                    </div>
                    <p>support@powerofmemory</p>
                </article>
            </a>

            <a href="https://www.google.com/maps/place/Paris" target="_blank">
                <article class="contact-info-display">
                    <div class="image-container">
                        <img src="assets/images/position.png" alt="Icon of a pin" />
                    </div>
                    <p>Paris</p>
                </article>
            </a>
        </section>

        <section id="contact-form">
            <form action="signup.php" method="POST">
                <div id="name-and-mail">
                    <input type="text" name="name" id="name" placeholder="Nom" required />
                    <input type="email" name="email" id="email" placeholder="Email" required />
                </div>
                <input type="text" name="object" id="object" placeholder="Sujet" required />
                <textarea name="message" id="message" placeholder="Message..." required></textarea>

                <!-- <button type="submit" name="signup-submit">Envoyer</button> -->
            </form>
            <a href="login.html"><button>Envoyer</button></a>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>