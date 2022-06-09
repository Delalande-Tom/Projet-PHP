<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';

class ControllerPanier
{
    protected static $object = 'panier';

    public static function readAll()
    {
        $produit = unserialize($_COOKIE["panier"]);
        $idProduit= $produit[0];
        echo "<ul>";
        if (empty($idProduit)) {
            $view = 'error/errorVide';
            $pagetitle = 'Votre Panier';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page panier vide
        }
        else{
        $view = 'panier';
        $pagetitle = 'Votre Panier';
        $path_array = array('view/view.php');
        require(File::build_Path($path_array));  // On affiche la page panier
        }
    }

    public static function ajoutPanier()
    {
        $qte = $_POST['qte'];
        $id_Tapis = $_POST['idTapis'];
        $view = 'ajoutPanier';
        $pagetitle = 'Bien ajouté à votre panier';
        $path_array = array('view/view.php');
        require(File::build_Path($path_array));  // On affiche la page panier

    }

    public static function delete(){
        $id_tapis = $_GET['id_tapis'];
        $view = 'delete';
        $pagetitle = "Suppression d'un tapis du panier";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page delete
    }

    public static function change(){
        $id_tapis = $_GET['id_tapis'];
        $view = 'change';
        $pagetitle = "Changer la quantité d'un tapis du panier";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page delete
    }

    public static  function modifierQuantite(){
        $qte = $_POST['qte'];
        $id_tapis = $_POST['idTapis'];
        $view = 'changeQuantity';
        $pagetitle = "Changer la quantité d'un tapis du panier";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page delete
    }



}