<?php

echo "<p> Voici la liste des différentes Commandes : </p>";
echo "<ul>";
foreach ($tab_commandes as $commande) {
    $id_commande = $commande->getIdCommande();
    $id_client = $commande->getIdClient();
    $id_commande_echappee = rawurlencode($commande->getIdCommande());
    $id_client_echappee = rawurlencode($commande->getIdClient());
    echo "<li>";
    echo "<a href='index.php?action=read&id_commande=$id_commande_echappee&id_client=$id_client_echappee&controller=commandes'>Commande N° $id_commande faite par $id_client</a>";
    if (Session::is_admin($_SESSION['login'])){
        echo"     <button><a href='index.php?action=delete&id_commande=$id_commande&controller=commandes'>Supprimer la commande</a></button>";
    }
    echo "</li>";

}
