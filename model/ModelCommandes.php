<?php
require_once 'Model.php';
require_once File::build_path(array('model','ModelClients.php')); // ModelClient

class ModelCommandes extends Model
{
    private $id_commande;
    private $id_client;
    private $montant_commande;
    protected  static $object = 'commandes';
    protected  static $primary = array('id_commandes',
                                        'id_client',);

    /**
     * @param $id_commandes
     * @param $id_client
     * @param $montant_commande
     * @param $date_commande
     * @param $etat_commande
     */


    public function __construct($id_client = NULL, $montant_commande = NULL, $date_commande = NULL)
    {
        if (!is_null($id_client) && !is_null($montant_commande)&&!is_null($date_commande)){
            $this->id_commande = NULL;
            $this->id_client = $id_client;
            $this->montant_commande = $montant_commande;
            $this->date_commande = $date_commande;
        }
    }




    public function getIdCommande()
    {
        return $this->id_commande;
    }


    public function getIdClient()
    {
        return $this->id_client;
    }


    public function getMontantCommande()
    {
        return $this->montant_commande;
    }


    public function getDateCommande()
    {
        return $this->date_commande;
    }

    public function  toArray(){
        $data = array ( "id_commande" => $this->id_commande, "id_client" => $this->id_client, "montant_commande" => $this->montant_commande,
                        "date_commande" => $this->date_commande);
        return $data;
    }

    public static function selectMaxIdCommande(){
        try {
            $sql = "SELECT MAX(id_commande) AS maximum
                FROM p_commandes";
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



    public static function commander(){
        try{
            $produit = unserialize($_COOKIE['panier']);
            $tab_id_produit = $produit[0];
            $tab_qte_produit = $produit[1];

            $prix_total = 0;
            for ($i = 0; $i < sizeof($tab_id_produit); $i++){
                $tapis = ModelTapis::select($tab_id_produit[$i]);
                if ($tapis->isTapisSolde()) {
                    $prix_tapis = $tapis->getPrix_solde();
                } else {
                    $prix_tapis = $tapis->getPrix();
                }
                $prix_total +=  $prix_tapis * $tab_qte_produit[$i];
            }

            $date = getdate();
            $year = (string) $date['year'];
            $month = (string) $date['mon'];
            $day = (string) $date['mday'];
            $date = $year . '-' . $month . '-' . $day;
            $login = $_SESSION['login'];
            $client = ModelClients::select($login);
            $id_client = $client->getId_client();
            $commande = new ModelCommandes($id_client ,$prix_total, $date);
            $commande->save();
            $max = ModelCommandes::selectMaxIdCommande();


            for ($i = 0; $i < sizeof($tab_id_produit); $i++) {
                $tapis = ModelTapis::select($tab_id_produit[$i]);
                $sql = "INSERT INTO p_ligne_commande (id_commande, id_tapis, nb_tapis) VALUES (:id_commande, :id_tapis, :nb_tapis);";
                if ($tapis->getStock() - $tab_qte_produit[$i] <= 0) {
                    $values = array(
                        'id_tapis' => $tab_id_produit[$i],
                        'id_commande' => $max,
                        'nb_tapis' => $tapis->getStock()
                    );
                } else {
                    $values = array(
                        'id_tapis' => $tab_id_produit[$i],
                        'id_commande' => $max,
                        'nb_tapis' => $tab_qte_produit[$i]
                    );
                }
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute($values);
            }

            for ($i = 0; $i < sizeof($tab_id_produit); $i++) {
                $tapis = ModelTapis::select($tab_id_produit[$i]);
                if ($tapis->getStock() - $tab_qte_produit[$i] <= 0) {
                    $sql = "UPDATE p_tapis SET stock = 0 WHERE id_tapis = :id_tapis";
                    $values = array(
                        'id_tapis' => $tab_id_produit[$i],
                    );
                } else {
                    $sql = "UPDATE p_tapis SET stock = :stock WHERE id_tapis = :id_tapis";
                    $values = array(
                        'id_tapis' => $tab_id_produit[$i],
                        'stock' => $tapis->getStock() - $tab_qte_produit[$i]
                    );
                }
                $req_prep = Model::getPDO()->prepare($sql);
                $req_prep->execute($values);
            }
                    $tab_id_produit = array();
                    $tab_qte_produit = array();
                    $produit = array($tab_id_produit, $tab_qte_produit);
                    setcookie ('panier', serialize($produit), time()+(86400*7), "__DIR__ . DIRECTORY_SEPARATOR .'..'");
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


    public static function selectAllCommandeByClient($id_client){
        try {
            $sql = "SELECT *
                        FROM p_commandes
                        WHERE id_client =:id_client";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array(
                'id_client' => $id_client
            );
            $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCommandes');
            $req_prep->execute($values);
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

    static public function selectCommande($id_commande, $id_client) {
        try{

            $sql = "SELECT * FROM p_commandes WHERE id_commande =:id_commande AND id_client =:id_client";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array(
                "id_commande" => $id_commande,
                "id_client" => $id_client
            );
            $req_prep->execute($values);
            $req_prep->setFetchMode(PDO::FETCH_CLASS, "ModelCommandes");
            $tab = $req_prep->fetchAll();
            if (empty($tab))
                return false;
            return $tab[0];
        } catch (PDOException $e){
            return false;
            if (Conf::getDebug()){
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function selectAllTapisFromCommandes($id_commande){
        try{

            $sql = "SELECT id_tapis, nb_tapis       
                    FROM p_ligne_commande WHERE id_commande =:id_commande";
            $req_prep = Model::getPDO()->prepare($sql);
            $values = array(
                "id_commande" => $id_commande,
            );
            $req_prep->execute($values);
            $tab = $req_prep->fetchAll();
            if (empty($tab))
                return false;
            return $tab;
        } catch (PDOException $e){
            if (Conf::getDebug()){
                return false;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function deleteCommande($id_commande){
        try {
                $pdo = Model::getPDO();
                $sql = "DELETE FROM p_commandes
                        WHERE id_commande = :id_commande";
                $req_prep = $pdo->prepare($sql);
                $values = array(
                    "id_commande" => $id_commande,
                );
                $req_prep->execute($values);
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                return false;
                die();
        }
    }

}