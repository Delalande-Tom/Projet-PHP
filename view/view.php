<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/general.css" rel="stylesheet" type="text/css" media="all" />
    <title><?php echo $pagetitle; ?></title>
</head>
<body>
    <header>
        <nav id="menu">
            <a href="index.php"><img src="ressources/logoTapis.png"></a>
            <ul>
                <li>
                    <a href="index.php?action=readAll&controller=tapis">Nos Tapis</a>
                </li>
                <li>
                    <a href="index.php?action=readAllFromCategorie&categorie=Tendance&controller=tapis">Nos tendances </a>
                </li>
                <li>
                    <a href="index.php?action=readAllTapisSoldes&controller=tapis">Les tapis soldés</a>
                </li>
                <li>
                    <a href="index.php?action=readAllFromCategorie&categorie=Enfants&controller=tapis">Les tapis enfants</a>
                </li>
                <li>
                    <a href="index.php?action=readAllFromCategorie&categorie=Prière&controller=tapis">Les tapis de prière</a>
                </li>

                <li>
                    <a href="index.php?action=readAll&controller=categories">Catégories</a>
                </li>
                <?php
                if (Session::is_admin($_SESSION['login'])) {
                    echo "<li>";
                    echo "<a href='index.php?action=readAll&controller=admin'>Commandes administrateur</a>";
                    echo "</li>";
                }
                ?>
                <li>
                    <form action="index.php?action=rechercher&controller=tapis" method="post">
                    <input id="searchbar" type="text" name="search" placeholder="Chercher un tapis">
                        <button type="submit"><img src=ressources/logoRechercher.png style="height: 10px; width: 10px"></button>
                    </form>
                </li>

            </ul>
            <div>
                <span> <a href="index.php?action=readAll&controller=panier"><img class="panier" src="ressources/panier.png"></a></span>
             <?php
                if (Session::is_admin($_SESSION['login'])) {
                   echo "<span> <a href='index.php?action=create&controller=clients'><img class='profil' src='ressources/signup.png'></a></span>";
                }
                ?>
                <?php
                if (!(Session::is_client($_SESSION['login']))) {
                   echo "<span> <a href='index.php?action=connect&controller=clients'><img class='profil' src='ressources/login.png'></a></span>";
                } else {
                    $tab = ModelClients::select($_SESSION['login']);
                    $id_client_echappee = rawurlencode($tab->getId_client());
                    echo "<span> <a href='index.php?action=read&id_client=$id_client_echappee&controller=clients'><img class='profil' src='ressources/login.png'></a></span>";
                }
                if (Session::is_client($_SESSION['login'])) {
                echo "<span> <a href='index.php?action=deconnect&controller=clients'><img class='profil' src='ressources/logOut.png'></a></span>";
                }
                ?>

            </div>
        </nav>
    </header>
    <div class="UwU">
        <?php
        $filepath = File::build_path(array("view", static::$object, "$view.php"));
        require $filepath;
        ?>
    </div>
    <footer>
        <ul>
            <li><a href="">Qui sommes-nous?</a></li>
            <li><a href="">Où nous retrouver?</a></li>
            <li><a href="">Politique</a></li>
        </ul>
        <p>Site de vente de tapis de TomBou</p>
        <p class="company">ZZCCMXTAPIS © 2021</p>
    </footer>
</body>
</html>
