<?php

namespace wesley\DB;
class Sql
{
    private const string HOSTNAME = "127.0.0.1";
    private const string USERNAME = "roott";
    private const string PASSWORD = "";
    private const string DBNAME = "db_ecommerce";

    private $conn;

    public function __construct()
    {

        $this->conn = new \PDO(
            "mysql:dbname=" . SQL::DBNAME .
            ";host=" . SQL::HOSTNAME,
            SQL::USERNAME,
            SQL::PASSWORD
        );

    }

    public function setParams($statement, $parameters = array())
    {

        foreach ($parameters as $key => $value) {
            $this->bindParam($statement, $key, $value);
        }

    }

    public function bindParam($statement, $key, $value)
    {

        $statement->bindParam($key, $value);

    }

    public function query($rawQuey, $params = array())
    {

        $stmt = $this->conn->prepare($rawQuey);
        $this->setParams($stmt, $params);
        $stmt->execute();

    }

    public function select($rawQuery, $params = array()): array
    {

        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

}
