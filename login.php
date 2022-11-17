<?PHP
require ('assets/includes/database.inc.php');

$error = 0;

if( filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || isset($_POST['password'])){

    $email = $_POST['email'];
    $password = $_POST['password'];


    $sth = $dbh->prepare('SELECT * FROM Utilisateur WHERE Email = :email AND Mdp = :password');
    $sth->execute(['Email'=> $email, 'Mdp'=> $password]);
    $donnees = $sth->fetch();
    if( $donnees == '' )
        $error = 1;
    else
        header('Location: ./site.php');
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

    <a href="#login-banner"><button id="fixed-button">⏏</button></a>

    <section id="chat-box">
        <section id="chat-box-header">
            <ul id="chat-list">
                <li>Général</li>
                <li id="selected-chat">Assistance</li>
                <li>AndréLicorne</li>
            </ul>
        </section>

        <section id="chat-box-main">
            <article>
                <p class="chat-msg">
                    Bonjour ! Je suis le robot d'assistance de Power Of
                    Memory. Posez-moi des questions si vous avez besoin
                    d'aide !
                </p>
                <p class="chat-date">16:49</p>
                <p class="chat-date">16:49</p>
            </article>

            <article>
                <p class="chat-my-msg">Qu'est-ce que Power Of Memory</p>
            </article>

            <article>
                <p class="chat-msg">
                    Power Of Memory est avant tout un jeu de memory
                </p>
            </article>
        </section>

        <section id="chat-box-footer">
            <form action="signup.php" method="POST">
                <textarea type="text" name="text" id="text" placeholder="Message ..." required></textarea>
                <input type="submit" name="send" value="Envoyer" />
            </form>
        </section>
    </section>

    <main>
        <section class="banner" id="login-banner">
            <h2>CONNEXION</h2>
        </section>

        <section id="login-form">
            <form action="signup.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required />
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />
                <!-- <button type="submit" name="signup-submit">Connexion</button> -->
            </form>
            <input href="memory.html"><button>Connexion</button></a>
            <input type="submit" name="signup-submit" value="Inscription">
        </section>
    </main>

    <?php
    include 'view/footer.inc.php';
    ?>
</body>

</html>
