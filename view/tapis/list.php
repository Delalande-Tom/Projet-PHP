<?php
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'created') {
            $id_tapis = htmlspecialchars($tapis->getId_tapis());
            echo "<p> Le tapis " . $id_tapis . " a bien été ajouté. </p>";
            $tab_tapis = ModelTapis::selectAll();
        } else if ($action == 'delete') {
            echo "<p> Le tapis " . htmlspecialchars($id_tapis) . " a bien été supprimé. </p>";
            $tab_tapis = ModelTapis::selectAll();

        } else if ($action == 'updated') {
            $id_tapis = htmlspecialchars($data['id_tapis']);
            echo "<p> Le tapis " . $id_tapis . " a bien été modifié. </p>";
            $tab_tapis = ModelTapis::selectAll();
        }
    }
    echo "<link href='css/list.css' rel='stylesheet' type='text/css' media='all' />";



    echo "<p> Voici la liste des différentes tapis : </p>";
    echo "<section class='products'>";
        foreach ($tab_tapis as $tapis) {
            echo "<div class='product-card'>";
                echo "<div>";
                    $nom_tapis = $tapis->getNom_tapis();
                    $id_tapis_echappee = rawurlencode($tapis->getId_tapis());
                    echo "<a  href='index.php?action=read&id_tapis=$id_tapis_echappee&controller=tapis'><img src='ressources/$id_tapis_echappee.jpg'></a>";
                    echo "</div>";
                    echo "<div>";
                    echo "<a href='index.php?action=read&id_tapis=$id_tapis_echappee&controller=tapis'>$nom_tapis</a><br>";
                    if (Session::is_admin($_SESSION['login'])) {
                        echo " <button><a href='index.php?action=delete&id_tapis=$id_tapis_echappee&controller=tapis'> supprimer</a></button>";
                        echo " <button><a href='index.php?action=update&id_tapis=$id_tapis_echappee&controller=tapis'>modifier le tapis</a></button>";
                    }
                    echo "</div>";
                echo "</div>";

        }
        echo "</section>";

?>
