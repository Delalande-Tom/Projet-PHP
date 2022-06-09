<?php

echo "<p> Votre panier : </p>";

$produit = unserialize($_COOKIE["panier"]);
$id_produit= $produit[0];
$qte_produit = $produit[1];


$_SESSION['idProduit']= $id_produit;
$_SESSION['qteProduit'] = $qte_produit;
$_SESSION['prixProduit'];
$_SESSION['prixTotal'];

echo "<ul>";
for ($i= 0; $i < sizeof($id_produit); $i++) {
    $tapis=ModelTapis::select($id_produit[$i]);
    $nom_tapis = $tapis->getNom_Tapis();
    if(!$tapis->isTapisSolde()){
        $_SESSION['prixProduit'] = $tapis->getPrix();
    } else {
        $_SESSION['prixProduit'] = $tapis->getPrix_solde();
    }
    $prix_tapis =  $_SESSION['prixProduit'];
    $prix_total_tapis = $qte_produit[$i]*$_SESSION['prixProduit'];
    $_SESSION['prixTotal'] = $_SESSION['prixTotal'] + $prix_total_tapis;

    echo "<a  href='index.php?action=read&id_tapis=$id_produit[$i]&controller=tapis'><img src='ressources/$id_produit[$i].jpg'></a><br>";
    echo "<button><a href='index.php?action=delete&id_tapis=$id_produit[$i]&controller=panier'>Supprimer du panier</a></button><br>";
    echo "<button><a href='index.php?action=change&id_tapis=$id_produit[$i]&controller=panier'>Modifier la quantité</a></button><br>";
    echo "<p>$qte_produit[$i]x $nom_tapis : $prix_tapis €</p>";

}
echo "</ul>";
echo "<br><br>";
echo "Montant total : ";
echo $_SESSION['prixTotal'] . "€";

if (Session::is_client($_SESSION['login'])){
    echo"<br><button><a href='index.php?action=commander&controller=commandes'>Commander</a></button><br>";
}else{
    echo "<br><button> <a href='index.php?action=connect&controller=clients'>Se connecter pour commander</a></button><br>";
}

?>