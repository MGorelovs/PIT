<?php ?>
    <header id="header">
        <h1><a href="index.php">LSDF</a></h1>
        <nav id="nav">
            <ul>
                <li><a href="index.php">Sākums</a></li>
                <li><a href="contacts.php">Kontakti</a></li>
                <?php if(isset($_SESSION['id'])){ ?>
                    <li><a href="databases.php">MySQL</a></li>
                <?php } ?>
                <li><a href="playlist.php">Spotify</a></li>
                <?php if(isset($_SESSION['id'])): ?>
                    <li><a href="logout.php" class="button special">Iziet</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="button special">Ieiet</a></li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>