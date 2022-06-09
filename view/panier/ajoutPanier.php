<?php

$tapis = ModelTapis::select($id_Tapis);
$nomTapis = $tapis->getNom_tapis();
$id_tapis_echappee = rawurlencode($id_Tapis);
echo "<img src='ressources/$id_tapis_echappee.jpg'>";
echo "<br>vous avez bien ajouté le tapis $nomTapis à votre panier";
ModelTapis::ajoutTapisAuPanier($qte,$id_Tapis);
?>
<br><br>
<a href="index.php?action=readAll&controller=tapis">retourner au shopping</a>
<br><br>
<a href="index.php?action=readAll&controller=panier">Aller au panier</a>


