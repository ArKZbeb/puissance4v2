<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <!-- faire un onglet déroulant de difficulté -->
    <form action="memory.php" method="post">
        <label for="difficulty">Choisissez la difficulté</label>
        <select name="difficulty" id="difficulty">
            <option value="easy" id="easy">Facile</option>
            <option value="medium" id="medium">Moyen</option>
            <option value="hard" id="hard">Difficile</option>
        </select>
     <!-- faire un onglet déroulant de thèmes -->
        <label for="theme">Choisissez le thème</label>
        <select name="theme" id="theme">
            <option value="pokemon" id="pokemon">Pokemon</option>
            <option value="tank" id="tank">Tank</option>
            <option value="lol" id="lol">League of Leagends</option>
        </select>

        <input type="submit" value="Jouer">
    <script src="script.js"></script>

</body>
</html>