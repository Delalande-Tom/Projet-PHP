<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
require_once File::build_path(array('model','Model.php')); // ModelGenerique
class Session{
    public static function is_client($login) {
        return (!empty($_SESSION['login']) && ($_SESSION['login'] == $login));
    }
    public static function is_admin($login) {
        $sql = "SELECT admin AS bool FROM p_clients WHERE login = :login ";
        $req_prep = Model::getPDO()->prepare($sql);
        $value = array('login'=>$login);
        $req_prep->execute($value);
        $tab = $req_prep->fetch();
        if($tab['bool'] == '1'){
            return true;
        }else {
            return false;
        }
    }
}
?>