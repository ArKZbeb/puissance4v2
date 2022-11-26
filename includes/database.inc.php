<?php
function connectDatabase($databaseName)
{
    $username = "root";
    $password = "root";

    try {
        $database = new PDO("mysql:host=localhost;dbname=$databaseName", $username, $password);

        return $database;
    } catch (PDOException $error) {
        die("Connection failed: " . $error->getMessage()); // Affiche le message d'erreur
    }
}
$database = connectDatabase("database");

function updateConnectionDate($accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET connection_date = NOW() WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function createAccount($email, $username, $password)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "INSERT INTO `user` (email, username, pass)
    VALUES (:email, :user, :pass)";
    $request = $database->prepare($sql);
    $request->bindParam("email", $email);
    $request->bindParam("user", $username);
    $request->bindParam("pass", $password);
    $request->execute();
}

function deleteAccount($accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "DELETE FROM `score` WHERE player_id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();

    $sql = "DELETE FROM `user` WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function updateEmail($newEmail, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET email = :email WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("email", $newEmail);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function updatePassword($newPassword, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "UPDATE `user` SET pass = :newPass WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("newPass", $newPassword);
    $request->bindParam("id", $accountId);
    $request->execute();
}

function getProfilePic($accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT pic FROM `user` WHERE id = :id";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->execute();

    $result = $request->fetch();

    return $result['pic'];
}

function getPosition($diff, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT player_id FROM `score` WHERE difficulty = :diff
    GROUP BY player_id
    ORDER BY MIN(score) ASC";
    $request = $database->prepare($sql);
    $request->bindParam("diff", $diff);
    $request->execute();
    $playerRank = 1;
    foreach ($request as $result) {
        if ($result['player_id'] == $accountId) {
            break; // Break the loop when the current player is found
        }
        $playerRank++;
    }
    return $playerRank;
}

function getBestTime($diff, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT MIN(score) FROM `score` WHERE player_id = :id AND difficulty = :diff";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->bindParam("diff", $diff);
    $request->execute();
    $result = $request->fetch();
    return $result['MIN(score)'];
}

function getNumberOfGames($diff, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT * FROM `score` WHERE player_id = :id AND difficulty = :diff";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->bindParam("diff", $diff);
    $request->execute();
    return $request->rowCount();
}

function getMinTries($diff, $accountId)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT MIN(tries) FROM `score` WHERE player_id = :id AND difficulty = :diff";
    $request = $database->prepare($sql);
    $request->bindParam("id", $accountId);
    $request->bindParam("diff", $diff);
    $request->execute();
    $result = $request->fetch();
    return $result['MIN(tries)'];
}

function getTopTen($diff)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT player_id, u.username AS uname, u.pic AS upic, MIN(Score) AS minscore,
    (@row_number := @row_number + 1) AS rownumber FROM `score` AS s
    INNER JOIN `user` AS u ON u.id = s.player_id
    INNER JOIN (SELECT @row_number := 0) AS row
    WHERE difficulty = :diff
    GROUP BY player_id
    ORDER BY MIN(score) ASC
    LIMIT 10";
    $request = $database->prepare($sql);
    $request->bindParam(':diff', $diff);
    $request->execute();
    return $request;
}

function getAllRank($diff)
{
    global $database; // Permet d'utiliser la variable $database définie dans le fichier database.inc.php

    $sql = "SELECT player_id, u.username AS uname, u.pic AS upic, MIN(Score) AS minscore,
    (@row_number := @row_number + 1) AS rownumber FROM `score` AS s
    INNER JOIN `user` AS u ON u.id = s.player_id
    INNER JOIN (SELECT @row_number := 0) AS row
    WHERE difficulty = :diff
    GROUP BY player_id
    ORDER BY MIN(score) ASC";
    $request = $database->prepare($sql);
    $request->bindParam(':diff', $diff);
    $request->execute();
    return $request;
}

function createLeaderboard($diff, $accountId)
{ ?>
<table>
    <thead>
        <tr>
            <th class="tprofil" colspan="2">Profil</th>
            <th class="tposition">Position</th>
            <th class="ttemps">Temps</th>
        </tr>
    </thead>
    <tbody>
        <?php
    $result = getTopTen($diff);

    foreach ($result as $row):
        $position = $result->rowCount() + 1 - $row['rownumber'];
        ?>
        <tr <?php if ($position==1) { echo 'class="top1"'; } else if ($position==2) { echo 'class="top2"'; } else if
            ($position==3) { echo 'class="top3"'; } ?>
            >
            <td class="cell-pic">
                <img class="profile-pic" src="assets/images/profiles/<?php echo $row['upic']; ?>" alt="profile picture">
            </td>
            <td class="cell-name">
                <?php echo $row['uname']; ?>
            </td>
            <td>
                <?php echo $position; ?>
            </td>
            <td>
                <?php echo $row['minscore']; ?> sec
            </td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php if (isConnected()): ?>
<img src="assets/images/ornament.svg" id="ornament" />

<table>
    <tbody>
        <?php
        $result = getAllRank($diff);
        $playerPosition = getPosition($diff, $accountId);

        foreach ($result as $row):
            $position = $result->rowCount() + 1 - $row['rownumber'];
            if ($position == $playerPosition - 1 || $position == $playerPosition || $position == $playerPosition + 1):
        ?>
        <tr
        <?php
            if ($position == $playerPosition) {
                echo 'class="self-stats"';
            }
        ?>
        >
            <td class="cell-pic">
                <img class="profile-pic" src="assets/images/profiles/<?php echo $row['upic']; ?>" alt="profile picture">
            </td>
            <td class="cell-name">
                <?php echo $row['uname']; ?>
            </td>
            <td>
                <?php echo $position; ?>
            </td>
            <td>
                <?php echo $row['minscore']; ?> sec
            </td>
        </tr>
        <?php endif; endforeach; ?>
    </tbody>

</table>


<?php else: ?>
<p>Pour consulter votre classement, <a href="login.php">connectez-vous !</a></p>

<?php
    endif;
} ?>