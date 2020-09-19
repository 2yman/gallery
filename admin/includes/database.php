<?php

class Database
{
 
private $connection;

    public function __construct() {

     $this->open_db_connection();

    }

    public function open_db_connection()
    {
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
        if ($this->connection->connect_error) {
          die("Database connection failed");
        }
    }


    public function query($sql)
    {
        $result  = $this->connection->query($sql);
        $this->confirmQuery($result);
        return $result;
    }

    public function confirmQuery($result)
    {
        if (!$result) {
            die("Query failed" . $this->connection->error);
        }
    }

    public function escapeString($string)
    {
        $escapedString = $this->connection->real_escape_string($string);
        return $escapedString;
    }
    
    public function theInsertId()
    {
        return $this->connection->insert_id;
    }
    

}

$database = new Database();










?>