<?php
$data = $tapis->toArray();
$id_tapis = $tapis->getId_tapis();
$stock = $tapis->getStock();
$id_tapis_echappee = rawurlencode($id_tapis);
$qtePanier = $tapis->qteTapisPanier($id_tapis);
$stockReel = $stock-$qtePanier;
$prixSolde = $tapis->getPrix_solde();
$coef_solde = $tapis->getCoefficient_solde();

echo "<img src='ressources/$id_tapis_echappee.jpg'>";
if ($coef_solde != 0) {

    echo "<p><h2>" . htmlspecialchars($data['nom_tapis']) ."</h2> (" . htmlspecialchars($data['largeur']) . "x" . htmlspecialchars($data['longueur']) .
        ") : <span style='text-decoration: line-through;'>" . htmlspecialchars($data['prix']) . "€</span> " .
        htmlspecialchars($prixSolde) . "€ </p>" ;

} else {
    echo "<p><h2>" . htmlspecialchars($data['nom_tapis']) . "</h2> (" . htmlspecialchars($data['largeur']) . "x" . htmlspecialchars($data['longueur']) .
        ") : " . htmlspecialchars($data['prix']) . "€</p>";
}

if (Session::is_admin($_SESSION['login'])) {
    echo "<p><button><a href='index.php?action=delete&id_tapis=$id_tapis_echappee&controller=tapis'>supprimer le tapis</a></button> </p>";
    echo "<p><button><a href='index.php?action=update&id_tapis=$id_tapis_echappee&controller=tapis'>modifier le tapis</a></button> </p>";
}

echo "<form method='post' action='index.php?action=ajoutPanier&controller=panier'>";


if ($stockReel>0){
echo "<input type='number' id='qte' name='qte' min='1' max='$stockReel' value='1' style='width: 50px'>";
echo "<input type='hidden' id='idTapis' name='idTapis' value=$id_tapis >" ;
echo "<input type='submit' value='Ajouter au panier'/>";
echo "</form>";
}
else{
   echo "<p>Le tapis n'est plus en stock</p>";
}


?>