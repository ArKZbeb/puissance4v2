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
    require('includes/session.inc.php');
?>
<body>

    <form action="test.php" method="post">
        <label for="message">Message</label>
        <input type="text" name="message" id="message" placeholder="Message ...">
        <input type="submit" value="Envoyer">
    </form>


    <?php
    $iduser=$_SESSION['id'];
    $username = $_SESSION['username'];

    $sql2 = "SELECT *  FROM `message` inner join `user` on user.id = message.sender_id";
    $sql3 = "SELECT *  FROM `user`";
    // selectionne tous les messages de la table message qui sont de moins de 24 heures
    $sql4 = "SELECT *  FROM `message` inner join `user` on user.id = message.sender_id WHERE message.date > DATE_SUB(NOW(), INTERVAL 1 DAY) order by message.date desc";

    $request = $database->prepare($sql4);
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    $request2 = $database->prepare($sql3);
    $request2->execute();
    $result2 = $request2->fetchAll(PDO::FETCH_ASSOC);
        

    
    foreach($result as $row){
        echo $row['date'];
        echo " ";
        echo $row['content'];
        echo " ";

        foreach($result2 as $row2){
            if($row['sender_id'] == $row2['id']){
                echo $row2['username'];
            }
        }
        echo "<br>";
    }

    if (isset($_SESSION['loggedin']) ) {
        // fait une condition qui verifie si le message fait plus de 3 caractères
        if (isset($_POST['message'] ) && strlen($_POST['message']) > 3) {
            $sql = "INSERT INTO `message` (`content`, `game_id`, `sender_id`) VALUES (:test, '1',:id_user)";

            echo $sql;

            $message = $_POST['message'];

            echo $message;

            $sth = $database->prepare($sql);
            $sth->bindParam('test', $message);
            $sth->bindParam('id_user', $iduser);
            $sth->execute();

        }
        else{
            echo "Votre message doit faire plus de 3 caractères";
        }
    }
    else {
        header('Location: test.php');
        echo "Vous n'êtes pas connecté";
    }

    ?>
    


    
</body>
</html>