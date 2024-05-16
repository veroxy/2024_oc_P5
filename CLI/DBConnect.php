<?php

class DBConnect
{
    private $db;
    private $dbname = "2024_oc_p5_cli";
    public function __construct()
    {
        try {
            // Pensez à modifier cette ligne avec le nom de votre base de données et vos identifiants
            $this->db = new PDO("mysql:host=localhost;dbname=$this->dbname;charset=utf8", 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        } catch (Exception $e) {
            die('Erreur dans la connexion au serveur: ' . $e->getMessage());
        }
    }

    function getPDO()
    {
        if ($this->db instanceof PDO) {
            return $this->db;
        }
    }

}