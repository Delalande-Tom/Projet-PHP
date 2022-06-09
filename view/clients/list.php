<?php


echo "<p> Voici la liste des différentes Client : </p>";
echo "<ul>";
foreach ($tab_client as $client) {
    $id_client = $client->getId_client();
    $id_client_echappee = rawurlencode($client->getId_client());
    $nom_client = $client->getNom();
    $prenom_client = $client->getPrenom();
    echo "<li>";
    echo "<a href='index.php?action=readAdmin&id_client=$id_client_echappee&controller=clients'>Client N° $id_client nommé
        $nom_client $prenom_client</a>";
    echo "<br><button><a href='index.php?action=delete&id_client=$id_client_echappee&controller=clients'> supprimer</a></button><br>";
    echo "<br><button><a href='index.php?action=update&id_client=$id_client_echappee&controller=clients'> modifier client</a></button><br>";
    echo "</li>";

}

?>