<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('model', 'ModelClients.php'));
require_once File::build_path(array('lib', 'Security.php'));
require_once File::build_path(array('lib', 'Session.php'));

class ControllerClients {

    protected static $object = 'clients';

    public static function readAll()
    {
        if (Session::is_admin($_SESSION['login'])) {
            $tab_client = ModelClients::selectAll();
            $view = 'list';
            $pagetitle = 'Liste des clients';
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));  // On affiche la page list
        }else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }

    }


    public static function create(){ // Creation d'un clients
        if (Session::is_admin($_SESSION['login']) || !(Session::is_client($_SESSION['login']))) {
            $view = 'update';
            $pagetitle = "Création d'un client";
            $path_array = array('view/view.php');
            require(File::build_Path($path_array));
        }else{
            $view = 'error/error';
            $pagetitle = "Page d'erreur";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page d'erreur de base
        }
    }

    public static function created(){ // clients créé
        if ($_POST['mdp'] == $_POST['confirm_mdp']){
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $data = array(
                    'prenom' => $_POST['prenom'],
                    'nom_client' => $_POST['nom_client'],
                    'mail' => $_POST['mail'],
                    'login' => $_POST['login'],
                    'mdp' => Security::hacher($_POST['mdp']),
                    'adresse' => $_POST['adresse'],
                    'ville' => $_POST['ville'],
                    'code_postal' => $_POST['code_postal'],
                    'date_naissance' => $_POST['date_naissance'],
                );
                $sql = "SELECT COUNT(*) AS nb FROM p_clients WHERE login = :login";
                $return = false;
                $req_prep = Model::getPDO()->prepare($sql);
                $value = array('login' => $_POST['login']);
                $req_prep->execute($value);
                $tab = $req_prep->fetch();
                if($tab['nb'] == '1'){
                    $return = true;
                }
                if($return == true){
                    echo "<p>Login déjà pris</p>";
                    $view = 'create';
                    $path_array = 'view/view.php';
                    require File::build_path($path_array);
                }
                $client = new ModelClients($data['prenom'], $data['nom_client'], $data['mail'], $data['adresse'],
                    $data['ville'], $data['code_postal'], $data['mdp'], $data['date_naissance'], $data['login'],false);

                $test = $client->save();
                if ($test === false){
                    $view = 'error/errorCreated';
                    $pagetitle = "Erreur création d'un client";
                    $path_array = array('view/view.php');
                    require File::build_Path($path_array); // On affiche la vue errorCreated

                } else {
                    $view = 'created';
                    $pagetitle = 'client créé';
                    $path_array = array('view/view.php');
                    require (File::build_Path($path_array)); // On affiche la vue created

                }

            } else {
                echo('mail incorrect');
                $view = 'create';
                $path_array = 'view/view.php';
                require File::build_path($path_array);
            }

        } else {
            echo "<p>Mots de passe différents</p>";
            $view = 'create';
            $path_array = 'view/view.php';
            require File::build_path($path_array);
        }
    }

    public static function update(){ // Mise a jour d'un utilisateur
        $id_client=$_GET['id_client'];
        $client = ModelClients::selectFromId($id_client);
        if ($client === false){
            $view = 'error/errorUpdate';
            $pagetitle = "Erreur creation formulaire de modification d'un client";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page errorUpdate
        } else {
            $view = 'update';
            $pagetitle = "Modification d'un client";
            $path_array = array('view/view.php');
            require (File::build_Path($path_array)); // On affiche la page update
        }
    }

    public static function updated(){ // On a mis a jour un utilisateur
        if ($_POST['mdp'] == $_POST['confirm_mdp']){
            if($_POST['admin']=="oui"){
                $admin=true;
            }else{
                $admin=false;
            }
            $data = array(
                'nom' => $_POST['nom_client'],
                'prenom' => $_POST['prenom'],
                'mail' => $_POST['mail'],
                'adresse' => $_POST['adresse'],
                'ville' => $_POST['ville'],
                'code_postal' => $_POST['code_postal'],
                'mot_de_passe' => Security::hacher($_POST['mdp']),
                'date_naissance' => $_POST['date_naissance'],
                'login' => $_POST['login'],
                'admin' => $admin,
                /*'nonce' => Security::generateRandomHex(),*/
            );
            $test = ModelClients::update($data);
            if ($test === false){
                $view = 'error/errorUpdated';
                $pagetitle = "Erreur modification d'un clients";
                $path_array = array('view/view.php');
                require File::build_Path($path_array); // On affiche la vue errorUpdated

            } else {
                $view = 'updated';
                $pagetitle = 'clients modifié';
                $path_array = array('view/view.php');
                require (File::build_Path($path_array)); // On affiche la vue updated

            }
        } else {
            echo "<p>Mots de passe différents</p>";
            $view = 'update';
            $path_array = 'view/view.php';
            require File::build_path($path_array);
        }
        /*$mail = "Lien : https://webinfo.iutmontp.univ-montp2.fr/~delalandet/eCommerce/index.php?action=validate&controller=clients&login=".$data['login']."&nonce=".$data['nonce'];
        mail(
            $data['mail'],
            'Mail vérification zzccmxtapis',
            $mail
        );*/

    }
    public static function delete(){
        if (Session::is_admin($_SESSION['login'])) {
            $id_client = $_GET['id_client'];
            $test = ModelClients::deleteClient($id_client);
            if ($test === false) {
                $view = 'error/errorDeleted';
                $pagetitle = "Erreur suppression d'un clients";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array)); // On affiche la page errorDeleted
            } else {
                $view = 'deleted';
                $pagetitle = "Suppression d'un clients";
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

    public static function connect(){
        $view = 'connect';
        $pagetitle = "Authentification";
        $path_array = array('view/view.php');
        require (File::build_path($path_array));
    }

    public static function deconnect(){
        $view = 'deconnect';
        $pagetitle = "déconexion";
        $path_array = array('view/view.php');
        session_start();
        session_destroy();
        require (File::build_path($path_array));
    }


    public static function connected(){
        $login = $_POST['login'];
        $mdp = Security::hacher($_POST['mdp']);
        $test = ModelClients::checkPassword($login, $mdp);
        /*$sql = "SELECT nonce AS nonce FROM p_clients WHERE login = :login ";
        $req_prep = Model::getPDO()->prepare($sql);
        $value = array('login'=>$login,);
        $req_prep->execute($value);
        $tab = $req_prep->fetch();*/
            if ($test == true){
                $_SESSION['login'] = $login;
                $view = 'detail';
                $pagetitle = "Détails de l'utilisateur";
                $path_array = array('view/view.php');
                require(File::build_Path($path_array));
            } else {
                $view = 'connect';
                $pagetitle = "Mauvais couple login/mot de passe";
                $path_array = array('view/view.php');
                require (File::build_path($path_array));
            }
    }

    public static function validate(){
        $login = $_GET['login'];
        $nonce = $_GET['nonce'];
        $sql = "SELECT COUNT (*) AS nonce FROM p_clients WHERE login = :login AND nonce = :nonce";
        $req_prep = Model::getPDO()->prepare($sql);
        $value = array('login'=>$login,
                            'nonce'=>$nonce);
        $req_prep->execute($value);
        $tab = $req_prep->fetch();
        if($tab['nonce'] == '1'){
            $sql = "UPDATE p_clients SET nonce = null WHERE login =:login";
            $req_prep = Model::getPDO()->prepare($sql);
            $value = array('login'=>$login,);
            $req_prep->execute($value);
        }
    }

    public static function readAdmin()
    {
        if (Session::is_admin($_SESSION['login'])) {
            $id_client = $_GET['id_client'];
            $client = ModelClients::selectFromId($id_client);
            if ($client === false) {
                $view = 'error/errorDetail';
                $pagetitle = "Erreur sur detail de l'utilisateur";
                // On affiche la page errorDetail
            } else {
                $view = 'detailAdmin';
                $pagetitle = "Détails admin de l'utilisateur";
                // On affiche la page detail
            }
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

    public static function read(){
        $id_client=$_GET['id_client'];
        $client = ModelClients::selectFromId($id_client);
        if ($client === false) {
            $view = 'error/errorDetail';
            $pagetitle = "Erreur sur detail de l'utilisateur";
            // On affiche la page errorDetail
        } else {
            $view = 'detail';
            $pagetitle = "Détails de l'utilisateur";
            // On affiche la page detail
        }
        $path_array = array('view/view.php');
        require(File::build_Path($path_array));
    }
}