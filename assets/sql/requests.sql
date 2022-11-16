Retourne la colonne "nom du joueur"
SELECT Pseudo FROM `utilisateur`;


Récuperer que les dernieres message "apres 24 heure"

SELECT * FROM `message` WHERE DateHeureMsg >= now() - INTERVAL 1 DAY;

--changer le mot de passe--
UPDATE `Utilisateur`
SET `Mdp` = $123456
WHERE `Email`= 'mailrare@yahoo.com';

--changer l'email--
UPDATE `Utilisateur` 
SET `Email` = 'mailmegarare@yahoo.com'
WHERE `Email`= 'mailepic@yahoo.com';

--trouve le meilleur score--
SELECT IdJoueur, ScorePartie
FROM Score
WHERE ScorePartie = ( SELECT MAX(ScorePartie) FROM Score );

--trouver le meilleur score d'un joueur en précis--
SELECT IdJoueur, ScorePartie
FROM Score
WHERE ScorePartie = ( SELECT MAX(ScorePartie) FROM Score WHERE IdJoueur = 10 );

--fonction pour éviter les doublons--
if($nouveauScore<= $bestscoredujoueur){
    $updatebestscore()
}else{
    DROP(nouveauScore)
}

SELECT * FROM Utilisateur WHERE Email = 'maillegendaire@yahoo.com' AND Mdp = '12345';


SELECT DISTINCT Jeux.NomJeu AS Game_name, Utilisateur.Pseudo AS Player_nick, DiffPartie AS
Difficulty, ScorePartie AS Score FROM `Score` 
INNER JOIN Jeux ON Score.IdJeu = Jeux.IdJeu
INNER JOIN Utilisateur ON Score.IdJoueur = Utilisateur.Identi

ORDER BY Jeux.NomJeu;

SELECT DISTINCT Jeux.NomJeu AS Game_name, Utilisateur.Pseudo AS Player_nick, DiffPartie AS
Difficulty, ScorePartie AS Score FROM `Score` 
INNER JOIN Jeux ON Score.IdJeu = Jeux.IdJeu
INNER JOIN Utilisateur ON Score.IdJoueur = Utilisateur.Identi
WHERE DiffPartie = 'Facile' // Jeux.NomJeu = 'MemoryGame' // Utilisateur.Pseudo = 'Bgdelastreet'
ORDER BY Jeux.NomJeu;