<?php

    require_once "Model.php";

    class ModelClients extends Model {

        private $id_client;
        private $prenom;
        private $nom;
        private $mail;
        private $adresse;
        private $ville;
        private $code_postal;
        private $mot_de_passe;
        private $date_de_naissance;
        private $login;
        private $nonce;
        private $admin;

        protected static $object = 'clients';
        protected static $primary = 'login';

        /**
         * modelUtilisateur constructor.
         * @param $id_client
         * @param $prenom
         * @param $nom
         * @param $mail
         * @param $adresse
         * @param $ville
         * @param $code_postal
         * @param $mot_de_passe
         * @param $date_de_naissance
         * @param $login
         */
        public function __construct($prenom = null, $nom = null, $mail = null, $adresse = null,
                                    $ville = null, $code_postal = null, $mot_de_passe = null, $date_de_naissance = null, $login = null, $admin = null)
        {
            if (!is_null($prenom) && !is_null($nom) && !is_null($mail) && !is_null($adresse)
                && !is_null($ville) && !is_null($code_postal) && !is_null($mot_de_passe) && !is_null($date_de_naissance)
                && !is_null($login) && !is_null($admin)){
                $this->id_client = null;
                $this->prenom = $prenom;
                $this->nom = $nom;
                $this->mail = $mail;
                $this->adresse = $adresse;
                $this->ville = $ville;
                $this->code_postal = $code_postal;
                $this->mot_de_passe = $mot_de_passe;
                $this->date_de_naissance = $date_de_naissance;
                $this->login = $login;
                $this->admin = $admin;
            }
        }


        /**
         * @return mixed
         */
        public function getId_client()
        {
            return $this->id_client;
        }

        /**
         * @return mixed
         */
        public function getPrenom()
        {
            return $this->prenom;
        }

        /**
         * @return mixed
         */
        public function getNom()
        {
            return $this->nom;
        }

        /**
         * @return mixed
         */
        public function getMail()
        {
            return $this->mail;
        }

        /**
         * @return mixed
         */
        public function getAdresse()
        {
            return $this->adresse;
        }

        /**
         * @return mixed
         */
        public function getVille()
        {
            return $this->ville;
        }

        /**
         * @return mixed
         */
        public function getCodePostal()
        {
            return $this->code_postal;
        }

        /**
         * @return mixed
         */
        public function getMdp()
        {
            return $this->mot_de_passe;
        }

        /**
         * @return mixed
         */
        public function getDateDeNaissance()
        {
            return $this->date_de_naissance;
        }

        /**
         * @return mixed
         */
        public function getLogin()
        {
            return $this->login;
        }

        /**
         * @return mixed
         */
        public function getAdmin()
        {
            return $this->admin;
        }



        public function toArray(){
            $data = array(
                'id_client' => $this->id_client,
                'prenom' => $this->prenom,
                'nom' => $this->nom,
                'mail' => $this->mail,
                'adresse' => $this->adresse,
                'ville' => $this->ville,
                'code_postal' => $this->code_postal,
                'mot_de_passe' => $this->mot_de_passe,
                'date_naissance' => $this->date_de_naissance,
                'login' => $this->login
                );
            return $data;
        }

        public static function selectFromId($id_client)
        {
            try{
                $sql = "SELECT * FROM p_clients WHERE id_client = :id_client";
                $req_prep = Model::getPDO()->prepare($sql);
                $value = array('id_client'=>$id_client);
                $req_prep->execute($value);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelClients");
                $tab = $req_prep->fetchAll();
                return $tab[0];
            }  catch (PDOException $e) {
                return false;
                    if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                    } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
}

        }

        public static function checkPassword($login, $mot_de_passe_hache){
            try{
            $sql = "SELECT COUNT(*) AS nb FROM p_clients WHERE login = :login AND mot_de_passe = :mot_de_passe_hache";
            $req_prep = Model::getPDO()->prepare($sql);
            $value = array('login'=>$login,
                            'mot_de_passe_hache'=>$mot_de_passe_hache);
            $req_prep->execute($value);
            $tab = $req_prep->fetch();
            if($tab['nb'] == '1'){
                return true;
            }else {
                return false;
            } } catch (PDOException $e) {
                if (Conf::getDebug()) {
                    return false;
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }
        public static function checkLogin($login){
            try{
            $sql = "SELECT COUNT(*) AS nb FROM p_clients WHERE login = :login";
            $req_prep = Model::getPDO()->prepare($sql);
            $value = array('login' => $login);
            $req_prep->execute($value);
            $tab = $req_prep->fetch();
            if($tab['nb'] == '1'){
                return true;
            }else {
                return false;
            } } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }
    }
?>