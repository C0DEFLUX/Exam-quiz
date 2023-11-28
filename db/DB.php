<?php

class DB
{
    private $host = "localhost";
    private $db_name = "exam-quiz";
    private $username = "root";
    private $password = "root";
    private $conn;

    public function getConnection()
    {
        try
        {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }

        catch (PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }

    public function select($query) {
        $db = $this->getConnection();
        try {
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function insert($table, $data)
    {
        $db = $this->getConnection();
        try
        {
            $columns = implode(', ', array_keys($data));
            $values = ':' . implode(', :', array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($values)";
            $stmt = $db->prepare($query);
            $stmt->execute($data);
            return $db->lastInsertId(); // Return the ID of the inserted record
        } catch (PDOException $e) {
            echo "Insert query failed: " . $e->getMessage();
        }
    }

}

$database = new DB();
$db = $database->getConnection();