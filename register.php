<?PHP
require('includes/database.inc.php');

$database = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emailPost = $_POST['email'];
    $passwordPost = $_POST['password'];
    $usernamePost = $_POST['username'];
    $passwordRepeatPost = $_POST['password-repeat'];

    $sql = "SELECT Identi FROM `Utilisateur` WHERE Email = :email";
    $request = $database->prepare($sql);
    $request->bindParam("email", $emailPost);
    $request->execute();

    $sql = "SELECT Identi FROM `Utilisateur` WHERE Pseudo = :username";
    $request2 = $database->prepare($sql);
    $request2->bindParam("username", $usernamePost);
    $request2->execute();

    if ($request->rowCount() > 0) {
        echo "Cet Email est déjà utilisé";
    } else if ($request2->rowCount() > 0) {
        echo "Ce Pseudo est déjà utilisé";
    } else {
        if ($passwordPost == $passwordRepeatPost) {
            $sql = "INSERT INTO `Utilisateur` (`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`)
                    VALUES (NULL , :email, :pass, :user, NOW(), NULL)";
            $request = $database->prepare($sql);
            $request->bindParam("email", $emailPost);
            $request->bindParam("pass", $passwordPost);
            $request->bindParam("user", $usernamePost);
            $request->execute();

            $_SESSION['email'] = $emailPost;
            $_SESSION['password'] = $passwordPost;
            header('Location: memory.php');
        } else {
            echo "Les mots de passe ne correspondent pas";
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
    include 'view/header.inc.php'
        ?>

    <a href="#signup-banner"><button id="fixed-button">⏏</button></a>

    <main>
        <section class="banner" id="signup-banner">
            <h2>INSCRIPTION</h2>
        </section>

        <section id="signup-form">
            <form action="register.php" method="POST">
                <input type="email" name="email" id="email" placeholder="Email" required />
                <input type="text" name="username" id="username" placeholder="Pseudo" required />
                <input type="password" name="password" id="password" placeholder="Mot de passe" required />
                <input type="password" name="password-repeat" id="password-repeat"
                    placeholder="Confirmez le mot de passe" required />
                <input type="submit" name="register-submit" value="Inscription" />
            </form>

            <!-- <a href="login.php"><button>Inscription</button></a> -->
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

</html>