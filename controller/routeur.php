<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('controller','ControllerTapis.php')); // ControllerTapis
require_once File::build_path(array('controller', 'ControllerCategories.php')); // ControllerCategories
require_once File::build_path(array('controller', 'ControllerPanier.php')); // ControllerPanier
require_once File::build_path(array('controller','ControllerClients.php')); // ControllerClients
require_once File::build_path(array('controller','ControllerCommandes.php')); // ControllerCommandes
require_once File::build_path(array('controller','ControllerAdmin.php')); // ControllerAdmin
require_once File::build_path(array('lib', 'Session.php'));


if (isset($_GET['action'])){ // On recupère l'action passée dans l'URL
    $action = $_GET['action'];
} else {
    $action = 'readAll'; // Lorsque l'on arrive sur le site on voit directement la meme page que si on etait sur readAll
}

if(isset($_GET['controller'])){ // On recupère le controleur dans l'URL
    $controller = $_GET['controller'];
} else {
    $controller = 'tapis';
}

$controller_class = 'Controller'. ucfirst($controller);

if(class_exists($controller_class)){
    $tab_methode_controller = get_class_methods($controller_class);
    if ((in_array($action, $tab_methode_controller))){
        // Appel de la méthode statique $action du controlleur récupéré dans l'URL
        $controller_class::$action();
    } else {

        $controller_class::error();
    }
} else {

    ControllerTapis::error();
}

