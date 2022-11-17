<?php 
require ('assets/includes/database.inc.php');

if(isset($_POST['username']) || isset($_POST['email'])){

    $sth = $dbh->prepare("INSERT INTO Utilisateur(Identi,Email,Mdp,Pseudo,DateHeureInscri,DateHconnexion)
    VALUES (?, ?, ?, NOW(), NULL");
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
    include 'view/header.inc.php'
        ?>

    <a href="#signup-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="signup-banner">
            <h2>INSCRIPTION</h2>
        </section>

        <section id="signup-form">
            <form action="signup.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required />
                <input type="text" name="username" id="username" placeholder="Pseudo" required />
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />
                <input type="password" name="password-repeat" id="password-repeat"
                    placeholder="Confirmez le mot de passe" required />
                <!-- <button type="submit" name="signup-submit">Inscription</button> -->
            </form>
            <input type="submit" name="signup-submit" value="Inscription">
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>
