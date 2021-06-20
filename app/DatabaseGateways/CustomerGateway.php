<?php

namespace App\DatabaseGateways;

class CustomerGateway {

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $statement = "
            SELECT 
                id, name, phone
            FROM
                customer;
        ";

        try {
            $statement = $this->db->query($statement);
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findWhereLike($value)
    {
        $statement = "
            SELECT 
                id, name, phone
            FROM
                customer
            WHERE phone LIKE ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(["(".$value.")%"]);
            return $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}