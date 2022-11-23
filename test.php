<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>" />
    <title>Document</title>
</head>
<?php
    session_start();
    require('includes/database.inc.php');
?>
<body>
<p class="espace">test</p>


<?php
    
    
    
        $database = connectDatabase();
    ?>
    <!-- mettre une box qui affiche tout les messages de la base de donnée -->
    <!-- mettre un formulaire pour envoyer un message -->
    <!-- mettre un bouton pour supprimer un message -->
    <!-- mettre un bouton pour modifier un message -->

    


    <!-- faire un chat interactif en ajax -->
    <form action="test.php" method="post">
        <input type="text" name="message">
        <input href="http://localhost:8888/Puissance4/puissance4v2/test.php" type="submit" value="Envoyer">
    </form>
    

    
    <?php
    $iduser=$_SESSION['id'];
    $username = $_SESSION['username'];
    $message = $_POST['message'];
    $date = $_POST['DateHeureMsg']; 

    // selectionner les messages de la base de donnée inferieur à 24 heures
    $sql2 = "SELECT *  FROM `Message`";
    $sql3 = "SELECT *  FROM `Utilisateur`";
    $sql4 = "SELECT * FROM `Message` WHERE DateHeureMsg < DATE_SUB(NOW(), INTERVAL 1 DAY) order by DateHeureMsg desc";

    $request = $database->prepare($sql2);
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $request2 = $database->prepare($sql3);
    $request2->execute();
    $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);

    
    foreach($result as $row){
        echo $row['DateHeureMsg'];
        echo " ";
        echo $row['Msg'];
        echo " ";
        foreach($result2 as $row){
            echo $row['Pseudo'];
        }
        echo "<br>";
    }
    
    // afficher les messages de l'utilisateur 1 de la base de donnée
    
    

    if (isset($_SESSION['loggedin']) ) {
        if (isset($_POST['message'])) {
            
            $sql = "INSERT INTO `Message` ( `Msg`, `DateHeureMsg`, `IdJeu`, `IdExpe`) VALUES (:Msg, CURRENT_TIMESTAMP, 1, :IdExpe)";
            
            $message = $_POST['message'];
            $sth = $database->prepare($sql);
            $sth->bindParam('IdExpe', $iduser);
            $sth->bindParam('Msg', $message);
            $sth->execute();
            
        }
    }
    else {
        header('Location: login.php');
        echo "Vous n'êtes pas connecté";
    }

    ?>
    


    
</body>
</html>