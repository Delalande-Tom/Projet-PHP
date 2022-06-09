<?php

class Conf
{
    static private $databases = array('hostname'=>'','database'=>'','login'=>'','password'=>'');

    static public function getLogin(){
        return self::$databases['login'];
    }

    static public function getHostname(){
        return self::$databases['hostname'];
    }

    static public function getDataBase(){
        return self::$databases['database'];
    }

    static public function getPassword(){
        return self::$databases['password'];
    }

    static private $debug = true;

    static public function getDebug() {
        return self::$debug;
    }
}
