<?php
class DB
{
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '199716';
    private $dbname = 'ws_concours';
    private $con;

    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=$this->host; dbname=$this->dbname", $this->user, $this->pass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function selectData($query, $params = [])
    {
        $data = [];
        try {
            $stm = $this->con->prepare($query);
            $stm->execute($params);
            $data = $stm->fetchAll(PDO::FETCH_BOTH);
        } catch (PDOException $e) {
            throw new Exception("Query execution failed: " . $e->getMessage());
        }
        return $data;
    }

    public function disconnect()
    {
        $this->con = null;
    }
}
