<?php
require_once __DIR__ . DIRECTORY_SEPARATOR .'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';
    $array = array('config' , 'Conf.php');
    require_once File::build_path($array);
    class Model {
        private static $pdo = NULL;

        public static function init(){
            $login = Conf::getLogin();
            $password = Conf::getPassword();
            $hostname = Conf::getHostname();
            $database_name = Conf::getDatabase();
            try{
                // Connexion à la base de données
                // Le dernier argument sert à ce que toutes les chaines de caractères
                // en entrée et sortie de MySql soit dans le codage UTF-8
                self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                         array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                  if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                    }
                    else {
                        echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                    }
                die();
            }


        }

        public static function getPDO(){
            if(is_null(self::$pdo)){
                self::init();
            }
            return self::$pdo;
        }

        static public function selectAll(){ // Renvoie tous les éléments de la table
            try {
                $table_name = static::$object;
                $class_name = 'Model' . ucfirst(static::$object);
                $table_name = 'p_' . static::$object;
                $rep = Model::getPDO()->query("SELECT * FROM $table_name");
                $rep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
                $tab = $rep->fetchAll();
                if (empty($tab)){
                    return false;
                }
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

        static public function select($primary_value) {
            try{
                $primary_key = static::$primary;
                $table_name = static::$object;
                $class_name = 'Model' . ucfirst($table_name);
                $table_name = 'p_' . static::$object;

                $sql = "SELECT * from $table_name WHERE $primary_key=:primary_value";
                $req_prep = Model::getPDO()->prepare($sql);
                $values = array(
                    "primary_value" => $primary_value,
                );
                $req_prep->execute($values);
                $req_prep->setFetchMode(PDO::FETCH_CLASS, "$class_name");
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



        public function save(){
            try {
                $table_name = 'p_' . static::$object;
                $values = array();
                $sql = "INSERT INTO $table_name (";
                $data = $this->toArray();
                foreach ($data as $key => $value) {
                    $sql = $sql . "$key, ";

                }
                $sql = rtrim($sql);
                $sql = rtrim($sql, ',');
                $sql = $sql . ") VALUES (";
                foreach ($data as $key => $value) {
                    $sql = $sql . ":$key, ";
                    $values[$key] = $value;
                }
                $sql = rtrim($sql);
                $sql = rtrim($sql, ',');
                $sql = $sql . ');';
                $pdo = Model::getPDO();
                $req_prep = $pdo->prepare($sql);
                $req_prep->execute($values);
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                   echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                die();
            }
        }


        public static function update($data){
            try {
                $primary_key = static::$primary;
                $table_name = 'p_' . static::$object;

                $sql = "UPDATE $table_name SET ";
                $values = array();
                foreach ($data as $key => $value) {
                    $sql = $sql . "$key = :$key, ";
                    $values[$key] = $value;
                }
                $sql = rtrim($sql);
                $sql = rtrim($sql, ',');
                $sql = $sql . " ";
                $sql = $sql . "WHERE $primary_key = :primary_value;";
                $values["primary_value"] = $data[$primary_key];
                $pdo = Model::getPDO();
                $req_prep = $pdo->prepare($sql);
                $req_prep->execute($values);
            } catch (PDOException $e){
                return false;
                if (Conf::getDebug()){
                    echo $e->getMessage();
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                die();
            }

        }


        public static function delete($primary_value){
            try {
                $primary_key = static::$primary;
                $table_name = 'p_' . static::$object;
                $pdo = Model::getPDO();
                $sql = "DELETE FROM $table_name
                        WHERE $primary_key = :primary_value";
                $req_prep = $pdo->prepare($sql);
                $values = array(
                    "primary_value" => $primary_value,
                );
                $req_prep->execute($values);
            } catch (PDOException $e) {
                return false;
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href="> retour a la page d\'accueil </a>';
                }
                die();
            }
        }


    }

?>