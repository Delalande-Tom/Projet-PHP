<?php

session_start();

$_SESSION['idProduit'] = 0;
$_SESSION['qteProduit'] = 0;
$_SESSION['prixProduit'] = 0;
$_SESSION['prixTotal'] = 0;

if (!isset($_SESSION['login'])){
    $_SESSION['login']=null;
}
if (!isset($_COOKIE["panier"])){
    $idProduit = array();
    $qteProduit =array();
    $produit = array($idProduit,$qteProduit);
    setcookie ("panier",serialize($produit),time()+(86400*7), "__DIR__");
}

require_once 'controller/routeur.php';

?>