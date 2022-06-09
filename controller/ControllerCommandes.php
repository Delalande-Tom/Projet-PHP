<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('model','ModelCommandes.php'));
require_once File::build_path(array('model', 'ModelClients.php'));

class ControllerCommandes
{

    protected static $object = 'commandes';

    public static function readAll()
    {
        if (Session::is_admin($_SESSION['login'])) {
            $tab_commandes = ModelCommandes::selectAll();
            if (empty($tab_commandes)){
                $view = 'error/errorList';
                $pagetitle = "Page d'erreur";
                $path_array = array('view/view.php');
                require (File::build_Path($path_array)); // On affiche la page d'erreur de base
            } else {
                $view = 'list';
                $pagetitle = 'Liste des commandes';
                $path_array = array('view/view.php');
                require(File::build_Path($path_array));  // On affiche la page list
            }
        }else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function read()
    {
        $id_commande = $_GET['id_commande'];
        $id_client = $_GET['id_client'];
        $client_courant = ModelClients::select($_SESSION['login']);
        $id_client_courant = $client_courant->getId_client();
        if ($id_client != $id_client_courant) {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base

        } else {
            $commande = ModelCommandes::selectCommande($id_commande, $id_client);
            $tab_tapis = ModelCommandes::selectAllTapisFromCommandes($id_commande);

            if ($commande === false) {
                $view = 'error/errorDetail';
                $pagetitle = "Error sur detail de la commande";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page errorDetail
            } else {
                $view = 'detail';
                $pagetitle = "Détails de la commande";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page detail
            }
        }
    }


    public static function create(){ // Creation d'une commande

        $categories = ModelCategories::selectAll();
        $view = 'update';
        $pagetitle = "Création d'un commande";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array));
    }

    public static function created(){ // commande créée
        $data = array(
            'id_commande' => $_POST['id_commande'],
            'nom_commande' => $_POST['nom_commande'],
            'largeur' => $_POST['largeur'],
            'longueur' => $_POST['longueur'],
            'prix' => $_POST['prix'],
            'coefficient_solde' => $_POST['coefficient_solde']/100,
            'marque' => $_POST['marque'],
            'stock' => $_POST['stock']
        );
        $commande = new Modelcommande($data['id_commande'], $data['nom_commande'], $data['largeur'], $data['longueur'], $data['prix'],
            $data['coefficient_solde'], $data['marque'], $data['stock']);

        $test = $commande->save();
        if ($test === false){
            $view = 'error/errorCreated';
            $pagetitle = "Erreur création d'un commande";
            $path_array = array('view/view.php');
            require File::build_Path($path_array); // On affiche la vue errorCreated

        } else {

            $categories = ModelCategories::selectAll();
            foreach ($categories as $cat){
                $nom_categorie = $cat->getNom_categorie();

                if ($nom_categorie == 'Produit'){
                    $id_categorie = $cat->getId_categorie();
                    $testAssigner = $commande->assignercommandeCategorie($id_categorie);
                }

                else {
                    if ($_POST["$nom_categorie"] == "oui") {
                        $id_categorie = $cat->getId_categorie();
                        $testAssigner = $commande->assignercommandeCategorie($id_categorie);
                    }
                }
            }

            $view = 'created';
            $pagetitle = 'commande créé';
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la vue created

        }
    }

    public static function update(){ // Mise a jour d'un utilisateur
        $categories = ModelCategories::selectAll();
        $id_commande=$_GET['id_commande'];

        $commande = Modelcommande::select($id_commande);
        if ($commande === false){
            $view = 'error/errorUpdate';
            $pagetitle = "Erreur creation formulaire de modification d'un commande";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page errorUpdate
        } else {
            $view = 'update';
            $pagetitle = "Modification d'un commande";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page update
        }
    }

    public static function updated(){ // On a mis a jour un utilisateur
        $data = array(
            'id_commande' => $_POST['id_commande'],
            'nom_commande' => $_POST['nom_commande'],
            'largeur' => $_POST['largeur'],
            'longueur' => $_POST['longueur'],
            'prix' => $_POST['prix'],
            'coefficient_solde' => $_POST['coefficient_solde']/100,
            'marque' => $_POST['marque'],
            'stock' => $_POST['stock'],
        );


        $test = Modelcommande::update($data);
        if ($test === false){
            $view = 'error/errorUpdated';
            $pagetitle = "Erreur modification d'un commande";
            $path_array = array('view/view.php');
            require File::build_Path($path_array); // On affiche la vue errorUpdated

        } else {

            $commande = new Modelcommande($data['id_commande'], $data['nom_commande'], $data['largeur'], $data['longueur'],
                $data['prix'], $data['coefficient_solde'], $data['marque'], $data['stock']);
            $categories = ModelCategories::selectAll();
            foreach ($categories as $cat){
                $nom_categorie = $cat->getNom_categorie();

                if ($nom_categorie == 'Produit'){
                } else {
                    if ($_POST["$nom_categorie"]== "oui") {
                        $id_categorie = $cat->getId_categorie();
                        $testAssigner = $commande->assignercommandeCategorie($id_categorie);
                    }
                    if ($_POST["$nom_categorie"]== "delete") {
                        $id_categorie = $cat->getId_categorie();
                        $testAssigner = $commande->deletecommandeCategorie($id_categorie);
                    }
                }
            }


            $view = 'updated';
            $pagetitle = "commande modifié";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la vue updated

        }
    }
    public static function delete(){
        if (Session::is_admin($_SESSION['login'])) {
            $id_commande = $_GET['id_commande'];
            $test = ModelCommandes::deleteCommande($id_commande);
            if ($test === false) {
                $view = 'error/errorDeleted';
                $pagetitle = "Erreur suppression d'un commande";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page errorDeleted
            } else {
                $view = 'deleted';
                $pagetitle = "Suppression d'une commande";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page deleted
            }
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function commander()
    {
        if (Session::is_client($_SESSION['login'])) {
            $produit = unserialize($_COOKIE['panier']);

            for ($i = 0; $i < sizeof($produit[0]); $i++) {
                if (ModelTapis::select($produit[0][$i])->getStock() - $produit[1][$i] < 0) {
                    $view = 'error/commandeError';
                    $pagetitle = "erreur de quantité";
                    $path_array = array('view/view.php');
                    require(File::build_Path($path_array)); // On affiche la page delete
                }
            }
            ModelCommandes::commander();
            $view = 'commande';
            $pagetitle = "Commander le panier";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page delete
        }
        else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function readAllCommandesByClient(){
        $id_client = $_GET['id_client'];
        $client_courant = ModelClients::select($_SESSION['login']);
        $id_client_courant = $client_courant->getId_client();
        if ($id_client != $id_client_courant){
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        } else {
            $tab_commandes = ModelCommandes::selectAllCommandeByClient($id_client);
            if ($tab_commandes == false) {
                $view = 'error/errorMesCommandes';
                $pagetitle = 'Erreur sur mes commandes';
                $path_array = array('view/view.php');
                require(File::build_path($path_array));

            } else {
                $view = 'list';
                $pagetitle = 'Mes commandes';
                $path_array = array('view/view.php');
                require(File::build_path($path_array));
            }
        }
    }


    public static function readAllCommandesByClientForAdmin(){
        if (Session::is_admin($_SESSION['login'])) {
            $id_client = $_GET['id_client'];
            $tab_commandes = ModelCommandes::selectAllCommandeByClient($id_client);
            if ($tab_commandes == false){
                $view = 'error/errorCommandesClient';
                $pagetitle = 'Erreur sur mes commandes';
                $path_array = array('view/view.php');
                require(File::build_path($path_array));

            }else {
                $view = 'list';
                $pagetitle = 'Mes commandes';
                $path_array = array('view/view.php');
                require(File::build_path($path_array));
            }
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }


    public static function error(){ // Erreur de base
        $view = 'error/error';
        $pagetitle = "Page d'erreur";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page d'erreur de base
    }
}
?>