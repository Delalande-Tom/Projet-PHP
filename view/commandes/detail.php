<?php
echo "<pre>";
$id_commande = htmlspecialchars($commande->getIdCommande());
$id_client = htmlspecialchars($commande->getIdClient());
$montant_commande = htmlspecialchars($commande->getMontantCommande());
$date_commande = htmlspecialchars($commande->getDateCommande());

echo "<p>identifiant de la commande : $id_commande</p>";
echo "<p>identifiant du client : $id_client</p>";
echo "<p>Montant de la commande : $montant_commande €</p>";
echo "<p>Date de la commande : $date_commande";
echo "</pre>";

foreach ($tab_tapis as $tapis){
    $nb_tapis = $tapis['nb_tapis'];
    $tapis = ModelTapis::select($tapis['id_tapis']);
    $id_tapis = $tapis->getId_tapis();
    $prix = $tapis->getPrix();
    $nom_tapis = $tapis->getNom_tapis();
    $id_tapis_echappee = rawurlencode($id_tapis);
    $prixSolde = $tapis->getPrix_solde();
    $coef_solde = $tapis->getCoefficient_solde();

    echo "<a  href='index.php?action=read&id_tapis=$id_tapis_echappee&controller=tapis'><img src='ressources/$id_tapis_echappee.jpg'></a>";
    if ($coef_solde != 0) {

        echo "<p>$nb_tapis" . 'x ' . htmlspecialchars($nom_tapis) ." : <span style='text-decoration: line-through;'>" . htmlspecialchars($prix) . "€</span> " .
            htmlspecialchars($prixSolde) . "€ </p>" ;

    } else {
        echo "<p>$nb_tapis" . 'x ' . htmlspecialchars($nom_tapis) . " : " . htmlspecialchars($prix) . "€</p>" ;
    }
}

?>

