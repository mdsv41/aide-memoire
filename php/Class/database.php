<?php
/**
 * Created by PhpStorm.
 * User: MdSV
 * Date: 2018/12
 *
 * Class gerant la connection à la base de donnée
 *
 */

namespace app;

use \PDO;

class database {

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    /**
     * @param $db_name
     * @param $db_user
     * @param $db_pass
     * @param $db_host
     */
    public function __construct ($db_name, $db_user, $db_pass, $db_host)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    /**
     * initialisation de PDO
     * @return PDO
     */
    private function getPDO()
    {
        if($this->pdo === null){
            $pdo = new PDO("mysql:dbname=".$this->db_name.";host=".$this->db_host, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * fonction permettant de lancer une requette
     * @param $requette
     * @return array
     */
    public function query($requette){
        $req = $this->getPDO()->query($requette);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
