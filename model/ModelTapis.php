<?php
    require_once 'Model.php';

    class ModelTapis extends Model
    {

        private $id_tapis;
        private $nom_tapis;
        private $largeur;
        private $longueur;
        private $prix;
        private $coefficient_solde;
        private $marque;
        private $stock;


        protected static $object = 'tapis';
        protected static $primary = 'id_tapis';

        public function __construct($id_tapis = NULL, $nom_tapis = NULL, $largeur = NULL, $longueur = NULL, $prix = NULL,
                                    $coefficient_solde = 0, $marque = NULL, $stock = NULL)
        {
            if (!is_null($id_tapis) && !is_null($nom_tapis) && !is_null($largeur) && !is_null($longueur) && !is_null($prix) &&
                    $coefficient_solde != 0 && !is_null($marque) && !is_null($stock)) {
                $this->id_tapis = $id_tapis;
                $this->nom_tapis = $nom_tapis;
                $this->largeur = $largeur;
                $this->longueur = $longueur;
                $this->prix = $prix;
                $this->coefficient_solde = $coefficient_solde;
                $this->marque = $marque;
                $this->stock = $stock;
            }
        }

        /**
         * @return mixed
         */
        public function getNom_Tapis()
        {
            return $this->nom_tapis;
        }

        /**
         * @return mixed
         */
        public function getLargeur()
        {
            return $this->largeur;
        }


        public function getLongueur()
        {
            return $this->longueur;
        }

        public function getDimensions()
        {
            return array($this->largeur, $this->longu . eur);
        }

        public function getPrix()
        {
            return $this->prix;
        }

        /**
         * @return mixed
         */
        public function getCoefficient_solde()
        {
            return $this->coefficient_solde;
        }

        public function getPrix_solde(){
            return $this->prix - $this->prix * $this->coefficient_solde / 100;
        }


        public function getCategorie()
        {
            return $this->categorie;
        }

        public function getMarque()
        {
            return $this->marque;
        }

        public function getId_tapis()
        {
            return $this->id_tapis;
        }

        public function getStock()
        {
            return $this->stock;
        }

        public function toArray()
        {
            $data = array(
                'id_tapis' => $this->id_tapis,
                'nom_tapis' => $this->nom_tapis,
                'largeur' => $this->largeur,
                'longueur' => $this->longueur,
                'prix' => $this->prix,
                'coefficient_solde' => $this->coefficient_solde,
                'marque' => $this->marque,
                'stock' => $this->stock
            );
            return $data;
        }


        public static function selectAllTapisSolde(){
            try {
                $sql = Model::getPDO()->query(
                    "SELECT *
                        FROM p_tapis pt
                        WHERE coefficient_solde != 0");
                $sql->setFetchMode(PDO::FETCH_CLASS, "ModelTapis");
                $tab = $sql->fetchAll();
                if (empty($tab))
                    return false;
                return $tab;
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }

        public function isTapisSolde(){
            $tab_tapis_solde = ModelTapis::selectAllTapisSolde();
            if (in_array($this, $tab_tapis_solde)){
                return true;
            }
            return false;
        }

        public static function selectAllTapisFromCategorie($categorie)
        {
            try {
                $sql = "SELECT pt.id_tapis, pt.nom_tapis, pt.largeur, pt.longueur, pt.prix, pt.marque, pt.stock 
                        FROM p_categories pc
                        JOIN p_ligne_categorie plc ON plc.id_categorie = pc.id_categorie
                        JOIN p_tapis pt ON pt.id_tapis = plc.id_tapis
                        WHERE nom_categorie =:categorie";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    'categorie' => $categorie
                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelTapis");
                $tab = $req_prep->fetchAll();
                if (empty($tab))
                    return false;
                return $tab;
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }

        public static function rechercher($data)
        {
            try {
                $sql = "SELECT DISTINCT pt.id_tapis, pt.nom_tapis, pt.largeur, pt.longueur, pt.prix, pt.coefficient_solde, pt.marque, pt.stock 
                        FROM p_categories pc
                        JOIN p_ligne_categorie plc ON plc.id_categorie = pc.id_categorie
                        JOIN p_tapis pt ON pt.id_tapis = plc.id_tapis
                        WHERE pt.nom_tapis LIKE :data 
                        OR pt.marque LIKE :data
                        OR nom_categorie LIKE :data";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    'data' => '%' . $data . '%'
                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelTapis");
                $tab = $req_prep->fetchAll();
                if (empty($tab))
                    return false;
                return $tab;
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }


        public function assignerTapisCategorie($id_categorie)
        {
            try {
                $sql = "INSERT INTO p_ligne_categorie VALUES (:id_categorie, :id_tapis)";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    'id_categorie' => $id_categorie,
                    'id_tapis' => $this->getId_tapis()
                );
                $req_prep->execute($values);
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                return false;
                die();
            }
        }



        public function deleteTapisCategorie($id_categorie)
        {
            try {
                $sql = "DELETE FROM p_ligne_categorie
                        WHERE id_categorie = :id_categorie
                        AND id_tapis = :id_tapis";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    'id_categorie' => $id_categorie,
                    'id_tapis' => $this->getId_tapis()
                );
                $req_prep->execute($values);
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                return false;
                die();
            }
        }




        public function isTapisInCateogorie($id_categorie){
            try {
                $sql = "SELECT COUNT(*) AS nb
                    FROM p_tapis pt
                    JOIN p_ligne_categorie plc ON pt.id_tapis = plc.id_tapis
                    JOIN p_categories pc ON plc.id_categorie = pc.id_categorie
                    WHERE pc.id_categorie = :id_categorie AND pt.id_tapis = :id_tapis";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    'id_tapis' => $this->getId_tapis(),
                    'id_categorie' => $id_categorie
                );
                $req_prep->execute($values);
                $true = $req_prep->fetch();
                if ($true['nb'] == '1'){
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }


        public static function SelectMaxIdTapis(){
            try {
                $sql = "SELECT MAX(id_tapis) AS maximum
                    FROM p_tapis";
                $rep = Model::getPDO()->query($sql);
                $res = $rep->fetch();
                $max = (int) $res['maximum'];
                return $max;
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
        }

        public static function qteTapisPanier($id){
            $produit =unserialize($_COOKIE['panier']);
            if (in_array($id,$produit[0])) {
                for ($i = 0; $i < sizeof($produit[0]); $i++) {
                    if ($produit[0][$i] == $id) {
                        return $produit[1][$i];
                    }
                }
            }else {
                return 0;
            }
        }


        public static function ajoutTapisAuPanier($qte,$id){
            $produit =unserialize($_COOKIE['panier']);
            if (in_array($id,$produit[0])){
                for ($i= 0; $i < sizeof($produit[0]);$i++){
                    if ($produit[0][$i]==$id){
                        $produit[1][$i] = $produit[1][$i]+$qte;
                    }
                }
            }
            else {
                array_push($produit[0], $id);
                array_push($produit[1], $qte);
            }
            setcookie ("panier",serialize($produit),time() + (86400 * 7), "__DIR__ . DIRECTORY_SEPARATOR .'..'");

        }

        public static function supprimerTapisDuPanier($id){
            $produit = unserialize($_COOKIE['panier']);
            for ($i = 0; $i < sizeof($produit[0]); $i++) {
                if ($produit[0][$i] == $id) {
                    unset($produit[0][$i]);
                    unset($produit[1][$i]);
                    $produit[0] = array_values($produit[0]);
                    $produit[1] = array_values($produit[1]);
                }
            }
            setcookie ("panier",serialize($produit),time() + (86400 * 7), "__DIR__ . DIRECTORY_SEPARATOR .'..'");
        }

        public static function modifierQuantiteTapisDuPanier($qte,$id){
            $produit = unserialize($_COOKIE['panier']);
            for ($i = 0; $i < sizeof($produit[0]); $i++) {
                if ($produit[0][$i] == $id) {
                    $produit[1][$i] = $qte;
                }
            }
            setcookie ("panier",serialize($produit),time() + (86400 * 7),"__DIR__ . DIRECTORY_SEPARATOR .'..'");
        }



    }
?>