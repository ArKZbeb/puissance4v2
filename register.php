<<<<<<< HEAD
<?php
require('includes/database.inc.php');

$database = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $emailpost = $_POST['email'];

    $sql = "SELECT Email FROM `utilisateur` WHERE Email = .'".$emailpost."'";
    $request = $database->query($sql);

    if ($request->rowCount() > 0) {
        "mail valide."
    } else {
        $sql = "INSERT INTO `Utilisateur`(`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`) VALUES (NULL , $emailpost,'12345','BeauGosseDu69','2022-11-09', NULL)";

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

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $emailPost = $_POST['email'];
                $usernamePost = $_POST['username'];
                $passwordPost = $_POST['password'];
                $passwordRepeatPost = $_POST['password-repeat'];

                $sql = "SELECT Identi FROM `Utilisateur` WHERE Email = :email";
                $request1 = $database->prepare($sql);
                $request1->bindParam("email", $emailPost);
                $request1->execute();

                $sql = "SELECT Identi FROM `Utilisateur` WHERE Pseudo = :user";
                $request2 = $database->prepare($sql);
                $request2->bindParam("user", $usernamePost);
                $request2->execute();

                if ($request1->rowCount() > 0) {
                    echo '<p class="error">';
                    echo "Cet Email est déjà utilisé";
                    echo '</p>';
                } else if ($request2->rowCount() > 0) {
                    echo "Ce Pseudo est déjà utilisé";
                } else {
                    if (!preg_match('/[a-zA-Z]/', $passwordPost) || !preg_match('/\d/', $passwordPost) || !preg_match('/[^a-zA-Z\d]/', $passwordPost)) {
                        echo "Le mot de passer doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial";

                    } else if (strlen($passwordPost) < 8) {
                        echo "Le mot de passer doit contenir au moins 8 caractères";

                    } else {
                        if ($passwordPost != $passwordRepeatPost) {
                            echo "Les mots de passe ne correspondent pas";

                        } else {

                            $sql = "INSERT INTO `Utilisateur` (`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`)
                                    VALUES (NULL , :email, :pass, :user, NOW(), NULL)";
                            $request = $database->prepare($sql);
                            $request->bindParam("email", $emailPost);
                            $request->bindParam("pass", $passwordPost);
                            $request->bindParam("user", $usernamePost);
                            $request->execute();

                            $_SESSION['email'] = $emailPost;
                            $_SESSION['password'] = $passwordPost;
                            header('Location: login.php');
                        }
                    }
                }
            }
            ?>

            <!-- <a href="login.php"><button>Inscription</button></a> -->
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

=======
<?PHP
require('includes/database.inc.php');

$database = connectDatabase();
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

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $emailPost = $_POST['email'];
                $usernamePost = $_POST['username'];
                $passwordPost = $_POST['password'];
                $passwordRepeatPost = $_POST['password-repeat'];

                $sql = "SELECT Identi FROM `Utilisateur` WHERE Email = :email";
                $request1 = $database->prepare($sql);
                $request1->bindParam("email", $emailPost);
                $request1->execute();

                $sql = "SELECT Identi FROM `Utilisateur` WHERE Pseudo = :user";
                $request2 = $database->prepare($sql);
                $request2->bindParam("user", $usernamePost);
                $request2->execute();

                if ($request1->rowCount() > 0) {
                    echo '<p class="error">';
                    echo "Cet Email est déjà utilisé";
                    echo '</p>';
                } else if ($request2->rowCount() > 0) {
                    echo "Ce Pseudo est déjà utilisé";
                } else {
                    if (!preg_match('/[a-z]/', $passwordPost) || !preg_match('/[A-Z]/', $passwordPost) || !preg_match('/\d/', $passwordPost) || !preg_match('/[^a-zA-Z\d]/', $passwordPost)) {
                        echo "Le mot de passer doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial";

                    } else if (strlen($passwordPost) < 8) {
                        echo "Le mot de passer doit contenir au moins 8 caractères";

                    } else {
                        if ($passwordPost != $passwordRepeatPost) {
                            echo "Les mots de passe ne correspondent pas";

                        } else {

                            $sql = "INSERT INTO `Utilisateur` (`Identi`, `Email`, `Mdp`, `Pseudo`, `DateHeureInscri`, `DateHconnexion`)
                                    VALUES (NULL , :email, :pass, :user, NOW(), NULL)";
                            $request = $database->prepare($sql);
                            $request->bindParam("email", $emailPost);
                            $request->bindParam("pass", $passwordPost);
                            $request->bindParam("user", $usernamePost);
                            $request->execute();
                            header('Location: login.php');
                        }
                    }
                }
            }
            ?>

            <!-- <a href="login.php"><button>Inscription</button></a> -->
        </section>
    </main>

    <?php
    include 'view/footer.inc.php'
        ?>
</body>

>>>>>>> 9dc4c69ed89072877b7dfbbfc5fbed0fa0548735
</html>