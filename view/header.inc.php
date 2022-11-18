<header id="homepage-header">
    <h1>The Power Of Memory</h1>
    <nav>
        <ul>
            <li><a href="index.php">ACCUEIL</a></li>
            <li><a href="register.php">JEU</a></li>
            <li><a href="scores.php">SCORES</a></li>
            <li><a href="contact.php">NOUS CONTACTER</a></li>

            <?php
            if (isset($_SESSION['id'])) {
                echo '<li><a href="myaccount.php"><img src="assets/images/profile.png" alt="Profile picture" /></a></li>';
            } else {
                echo '<li><a href="login.php">SE CONNECTER</a></li>';
            }
            ?>
            
        </ul>
    </nav>
</header>