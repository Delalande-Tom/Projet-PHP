<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('model','ModelCategories.php'));

class ControllerCategories{
    protected static $object = 'categories';

    public static function readAll()
    {
        $tab_categorie = ModelCategories::selectAll();

        if (empty($tab_categorie)){
            $view = 'errorList';
            $pagetitle = 'Pas de catégorie';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page errorList
        }
        $view = 'list';
        $pagetitle = 'Liste des categories';
        $path_array = array('view/view.php');
        require(File::build_Path($path_array));  // On affiche la page list
    }
    public static function create(){ // Creation d'une categorie
        if (Session::is_admin($_SESSION['login'])) {
            $view = 'create';
            $pagetitle = "Création d'une categorie";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));
        }
        else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function update(){ // Creation d'une categorie
        if (Session::is_admin($_SESSION['login'])) {
            $view = 'update';
            $pagetitle = "Renommer une categorie";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));
        }
        else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function updated(){
        $data = array('nom_categorie' => $_POST['nom_categorie'],
            'id_categorie' => $_POST['id_categorie']);
        $test = ModelCategories::update($data);
        if ($test === false){
            $view = 'error/errorUpdated';
            $pagetitle = "Erreur modification d'un tapis";
            $path_array = array('view/view.php');
            require File::build_Path($path_array); // On affiche la vue errorUpdated
        }else{
            $view = 'updated';
            $pagetitle = "categorie modifiée";
            $path_array = array('view/view.php');
            require File::build_Path($path_array); // On affiche la vue errorUpdated
        }
    }

    public static function created(){
        if (Session::is_admin($_SESSION['login'])) {
        $data = array(
            'id_categorie' => $_POST['id_categorie'],
            'nom_categoire' => $_POST['nom_categorie']
        );

        $categorie = new ModelCategories($data['id_categorie'], $data['nom_categoire']);
        $test = $categorie->save();

        if ($test === false) {
            $view = 'error/errorCreated';
            $pagetitle = "Erreur création d'un tapis";
            $path_array = array('view/view.php');
            require File::build_Path($path_array); // On affiche la vue errorCreated
        } else {
            $view = 'created';
            $pagetitle = 'Categorie créée';
            $path_array = array('view/view.php');
            require (File::build_path($path_array));  // On affiche la vue created
        }}else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }


    }

    public static function delete()
    {
        if (Session::is_admin($_SESSION['login'])) {

        $id_categorie = $_GET['id_categorie'];
        $test = ModelCategories::delete($id_categorie);
        if ($test === false) {
            $view = 'error/errorDeleted';
            $pagetitle = "Erreur suppression d'une categorie";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page errorDeleted
        } else {
            $view = 'list';
            $pagetitle = "Suppression d'une categorie";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array)); // On affiche la page deleted
        }
        }
        else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }


    public static function error(){ // Erreur de base
        $view = 'error/error';
        $pagetitle = "Page d'erreur";
        $path_array = array('view/view.php');
        require (File::build_Path($path_array)); // On affiche la page d'erreur de base
    }
}