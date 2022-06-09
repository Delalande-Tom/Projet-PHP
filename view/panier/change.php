
<?php
$tapis = ModelTapis::select($id_tapis);
$nomTapis = $tapis->getNom_tapis();
$stock = $tapis->getStock();
$qtePanier = $tapis->qteTapisPanier($id_tapis);
echo"<p>Changer la quantité du tapis $nomTapis </p>";
echo "<img src='ressources/$id_tapis.jpg'>";
echo "<form method='post' action='index.php?action=modifierQuantite&controller=panier'>";
echo "<input type='number' id='qte' name='qte' min='0' max='$stock' value='$qtePanier' style='width: 50px'>";
echo "<input type='hidden' id='idTapis' name='idTapis' value=$id_tapis >" ;
echo "<input type='submit' value='Modifier quantité'/>";
echo "</form>";

?>