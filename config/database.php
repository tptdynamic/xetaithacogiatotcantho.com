<?php

class Database {
    private $db = null;
    private $connection_status = null;
    private $sql = '';
    private $params = null;
    private $stmt = null;

    public function __construct($connect = null) {
        if ($connect == null) $connect = include "connect.php";
        $connection_string = "mysql:host=" . $connect->host . "; port=" . $connect->port . "; dbname=" . $connect->dbname;
        
        try {
            $this->db = new PDO($connection_string, $connect->user, $connect->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->query("SET NAMES 'utf8'; SET time_zone = '". Config::UTC ."'");
            $this->connection_status = "ok";
        } catch (PDOException $ex) {
            $this->connection_status = $ex->getCode();
        }
    }

    public function set_query($sql = '', array $params = null) {
        $this->sql = $sql;
        $this->params = $params;
    }

    public function load_rows()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $this->stmt->execute($this->params);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $this->stmt->fetchAll();
    }

    public function load_row()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $this->stmt->execute($this->params);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $this->stmt->fetch();
    }

    public function query($sql) {
        try {
            $this->db->query($sql);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function get_db_status() {
        return $this->connection_status;
    }

    public function execute_return_status()
    {
        try {
            $this->stmt = $this->db->prepare($this->sql);
            $this->stmt->setFetchMode(PDO::FETCH_OBJ);
            $status = $this->stmt->execute($this->params);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $status;
    }
}

?>