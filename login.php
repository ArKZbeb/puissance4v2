<?PHP
session_start();

require('includes/database.inc.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* ------------------------------- Connection ------------------------------- */
    if (isset($_POST['login-submit'])) {
        $emailpost = $_POST['login-email'];
        $passwordpost = $_POST['login-password'];

        $sql = "SELECT * FROM `Utilisateur` WHERE Email = :mail AND Mdp = :mdp";
        $request = $database->prepare($sql);
        $request->bindParam(':mail', $emailpost);
        $request->bindParam(':mdp', $passwordpost);
        $request->execute();

        if ($request->rowCount() < 1) {
            $connectionError = "Email ou mot de passe incorrect";

        } else {
            $_SESSION['email'] = $emailpost;
            $_SESSION['password'] = $passwordpost;
            $_SESSION['id'] = $request->fetch()['Identi'];
            $_SESSION['username'] = $request->fetch()['Pseudo'];
            // $_SESSION['id'] = $request->fetch()[0]['Identi'];
            // $_SESSION['username'] = $request->fetch()[0]['Pseudo'];
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
            exit();
        }
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
            <form action="login.php" method="POST">
                <input type="email" name="login-email" id="email" placeholder="Email" required />
                <input type="password" name="login-password" id="password" placeholder="Mot de passe" required />
                <input type="submit" name="login-submit" value="Connexion" />
            </form>
            <?php
            if ($connectionError != null) {
                echo '<p class="form-msg form-error">';
                echo $connectionError;
                echo '</p>';
            } else if ($_SESSION['accountCreated']) {
                echo '<p class="form-msg form-success">Votre compte a été créé avec succès ! Connectez vous.</p>';
                unset($_SESSION['accountCreated']);
            }
            ?>
            <!-- <a href="memory.php"><button>Connexion</button></a> -->

            <p> Pas encore de compte ? <a href="register.php">Créez un compte.</a></p>
        </section>
    </main>

    <?php
    include 'view/footer.inc.php';
    ?>
</body>

</html>