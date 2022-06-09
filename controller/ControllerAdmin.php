
<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
class ControllerAdmin
{
    protected static $object = 'admin';
    public static function readAll()
    {
        if (Session::is_admin($_SESSION['login'])) {
            $view = 'commandeAdmin';
            $pagetitle = 'Liste des commandes admin';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        } else{
                $view = 'error/error';
                $pagetitle = "Page d'erreur";
                $path_array = array('view/view.php');
                require (File::build_Path($path_array)); // On affiche la page d'erreur de base
            }
    }

}
?>