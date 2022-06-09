
<?php

$tapis = ModelTapis::select($id_tapis);
$nom_tapis = $tapis->getNom_Tapis();
ModelTapis::supprimerTapisDuPanier($id_tapis);
echo "le $nom_tapis à été supprimé du panier";
?>
<meta http-equiv="refresh" content="0; URL=index.php?action=readAll&controller=panier"">
<br><br>
<a href="index.php?action=readAll&controller=tapis">Aller au shopping</a>
<br><br>
<a href="index.php?action=readAll&controller=panier">Retour au panier</a>

