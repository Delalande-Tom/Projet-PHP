<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('model','ModelTapis.php'));

class ControllerTapis
{

    protected static $object = 'tapis';

    public static function readAll()
    {
        $tab_tapis = ModelTapis::selectAll();
        if ($tab_tapis == false){
            $view = 'error/errorList';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        } else {
            $view = 'list';
            $pagetitle = 'Liste des tapis';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
    }


    public static function readAllTapisSoldes()
    {

        $tab_tapis = ModelTapis::selectAllTapisSolde();
        if ($tab_tapis == false){
            $view = 'error/errorSolde';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        } else {
            $view = 'list';
            $pagetitle = 'Liste des tapis';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
    }

    public static function read()
    {
        $id_tapis = $_GET['id_tapis'];
        $tapis = ModelTapis::select($id_tapis);
        if ($tapis === false) {
            $view = 'error/errorDetail';
            $pagetitle = "Error sur detail du tapis";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page errorDetail
        } else {
            $view = 'detail';
            $pagetitle = "Détails du tapis";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page detail
        }
    }

    public static function readAllFromCategorie(){
        $categorie = $_GET['categorie'];
        $tab_tapis = ModelTapis::selectAllTapisFromCategorie($categorie);
        if($tab_tapis === false){
            $view = 'error/errorReadFromCategorie';
            $pagetitle = 'Erreur de read fromcategorie';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
        else {
            $view = 'list';
            $pagetitle = 'Liste des tapis';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
    }

    public static function rechercher(){
        $data = $_POST['search'];
        $tab_tapis = ModelTapis::rechercher($data);
        if($tab_tapis === false){
            $view = 'error/errorRechercher';
            $pagetitle = 'Erreur de rechercher';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
        else {
            $view = 'list';
            $pagetitle = 'Liste des tapis';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }
    }

    public static function create() { // Creation d'un tapis
        if (Session::is_admin($_SESSION['login'])) {
            $categories = ModelCategories::selectAll();
            $view = 'update';
            $pagetitle = "Création d'un tapis";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function created() { // Tapis créé
        if (Session::is_admin($_SESSION['login'])) {
            $data = array(
                'id_tapis' => $_POST['id_tapis'],
                'nom_tapis' => $_POST['nom_tapis'],
                'largeur' => $_POST['largeur'],
                'longueur' => $_POST['longueur'],
                'prix' => $_POST['prix'],
                'coefficient_solde' => $_POST['coefficient_solde'],
                'marque' => $_POST['marque'],
                'stock' => $_POST['stock']
            );

            $tapis = new ModelTapis($data['id_tapis'], $data['nom_tapis'], $data['largeur'], $data['longueur'], $data['prix'],
                $data['coefficient_solde'], $data['marque'], $data['stock']);

            $test = $tapis->save();
            if ($test === false) {
                $view = 'error/errorCreated';
                $pagetitle = "Erreur création d'un tapis";
                $path_array = array('view/view.php');
                require File::build_Path($path_array); // On affiche la vue errorCreated

            } else {

                $categories = ModelCategories::selectAll();
                foreach ($categories as $cat) {
                    $nom_categorie = $cat->getNom_categorie();

                    if ($nom_categorie == 'Produit') {
                        $id_categorie = $cat->getId_categorie();
                        $testAssigner = $tapis->assignerTapisCategorie($id_categorie);
                    } else {
                        if ($_POST["$nom_categorie"] == "oui") {
                            $id_categorie = $cat->getId_categorie();
                            $testAssigner = $tapis->assignerTapisCategorie($id_categorie);
                        }
                    }
                }

                $view = 'list';
                $pagetitle = 'Tapis créé';
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la vue created
            }
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function update(){ // Mise a jour d'un utilisateur
        if (Session::is_admin($_SESSION['login'])) {
            $categories = ModelCategories::selectAll();
            $id_tapis = $_GET['id_tapis'];
            $tapis = ModelTapis::select($id_tapis);
            if ($tapis === false) {
                $view = 'error/errorUpdate';
                $pagetitle = "Erreur creation formulaire de modification d'un tapis";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page errorUpdate
            } else {
                $view = 'update';
                $pagetitle = "Modification d'un tapis";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page update
            }
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }

    }

    public static function updated(){ // On a mis a jour un utilisateur
        if (Session::is_admin($_SESSION['login'])) {
            $data = array(
                'id_tapis' => $_POST['id_tapis'],
                'nom_tapis' => $_POST['nom_tapis'],
                'largeur' => $_POST['largeur'],
                'longueur' => $_POST['longueur'],
                'prix' => $_POST['prix'],
                'coefficient_solde' => $_POST['coefficient_solde'],
                'marque' => $_POST['marque'],
                'stock' => $_POST['stock'],
            );


            $test = ModelTapis::update($data);
            if ($test === false) {
                $view = 'error/errorUpdated';
                $pagetitle = "Erreur modification d'un tapis";
                $path_array = array('view/view.php');
                require File::build_Path($path_array); // On affiche la vue errorUpdated

            } else {

                $tapis = new ModelTapis($data['id_tapis'], $data['nom_tapis'], $data['largeur'], $data['longueur'],
                    $data['prix'], $data['coefficient_solde'], $data['marque'], $data['stock']);
                $categories = ModelCategories::selectAll();
                foreach ($categories as $cat) {
                    $nom_categorie = $cat->getNom_categorie();

                    if ($nom_categorie == 'Produit') {
                    } else {
                        if ($_POST["$nom_categorie"] == "oui") {
                            $id_categorie = $cat->getId_categorie();
                            $testAssigner = $tapis->assignerTapisCategorie($id_categorie);
                        }
                        if ($_POST["$nom_categorie"] == "delete") {
                            $id_categorie = $cat->getId_categorie();
                            $testAssigner = $tapis->deleteTapisCategorie($id_categorie);
                        }
                    }
                }


                $view = 'list';
                $pagetitle = 'Tapis modifié';
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la vue updated

            }
        } else {
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page d'erreur de base
        }

    }
    public static function delete(){
        if (Session::is_admin($_SESSION['login'])) {
            $id_tapis = $_GET['id_tapis'];
            $test = ModelTapis::delete($id_tapis);
            if ($test === false) {
                $view = 'error/errorDeleted';
                $pagetitle = "Erreur suppression d'un tapis";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page errorDeleted
            } else {
                $view = 'list';
                $pagetitle = "Suppression d'un tapis";
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

    public static function error(){ // Erreur de base
        $view = 'error/error';
        $pagetitle = "Page d'erreur";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page d'erreur de base
    }
}

?>