<?php ?>
    <header id="header">
        <h1><a href="index.php">LSDF</a></h1>
        <nav id="nav">
            <ul>
                <li><a href="index.php">Sākums</a></li>
                <li><a href="contacts.php">Kontakti</a></li>
                <li><a href="sacensibas.php">Sacensības</a></li>
<!--                <li><a href="playlist.php">Spotify</a></li>-->
                <li><a href="registracija.php">Reģistrācija</a></li>
                <?php if(isset($_SESSION['authorized'])): ?>
                    <li><a href="logout.php" class="button special">Iziet</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="button special">Ieiet</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>