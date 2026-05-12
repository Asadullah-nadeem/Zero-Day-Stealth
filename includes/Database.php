<?php
/**
 * Database Class
 * Provides a wrapper for PDO to simplify common database operations.
 */

class Database {
    private $pdo;
    private $error;

    public function __construct($host, $dbname = null, $user, $pass, $port = '3306', $charset = 'utf8mb4') {
        $dsn = "mysql:host=$host;port=$port;charset=$charset";
        if ($dbname) {
            $dsn .= ";dbname=$dbname";
        }
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            throw new Exception("Connection failed: " . $this->error);
        }
    }

    /**
     * Execute a query with optional parameters
     */
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Query failed: " . $e->getMessage());
        }
    }

    /**
     * Fetch all results from a query
     */
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Fetch a single row from a query
     */
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Insert a record into a table
     */
    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $this->query($sql, array_values($data));
        return $this->pdo->lastInsertId();
    }

    /**
     * Update records in a table
     */
    public function update($table, $data, $where, $whereParams = []) {
        $set = "";
        $params = [];
        
        foreach ($data as $key => $value) {
            $set .= "$key = ?, ";
            $params[] = $value;
        }
        $set = rtrim($set, ', ');
        
        $sql = "UPDATE $table SET $set WHERE $where";
        $params = array_merge($params, $whereParams);
        
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    /**
     * Delete records from a table
     */
    public function delete($table, $where, $whereParams = []) {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->query($sql, $whereParams);
        return $stmt->rowCount();
    }

    /**
     * Get the PDO instance
     */
    public function getPdo() {
        return $this->pdo;
    }
}
?>
