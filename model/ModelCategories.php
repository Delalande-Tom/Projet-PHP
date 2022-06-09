<?php
require_once 'Model.php';
class ModelCategories extends Model {
    private  $id_categorie;
    private $nom_categorie;

    protected  static $object = 'categories';
    protected  static $primary = 'id_categorie';

    /**
     * @param $id_categorie
     * @param $nom_categorie
     */
    public function __construct($id_categorie = NULL, $nom_categorie= NULL)
    {
        if (!is_null($id_categorie) && !is_null($nom_categorie)){
        $this->id_categorie = $id_categorie;
        $this->nom_categorie = $nom_categorie;
        }
    }

    /**
     * @return mixed
     */
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * @return mixed
     */
    public function getNom_categorie()
    {
        return $this->nom_categorie;
    }

    public function toArray(){
        $data = array(
            'id_categorie' => $this->id_categorie,
            'nom_categorie' => $this->nom_categorie,
        );
        return $data;
    }

    public static function SelectMaxIdCategorie(){
        try {
            $sql = "SELECT MAX(id_categorie) AS maximum
                    FROM p_categorie";
            $rep = Model::getPDO()->query($sql);
            $res = $rep->fetch();
            $max = (int) $res['maximum'];
            return $max;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                return false;
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }


}