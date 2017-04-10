<?php

class Database {

    private static $instance;
    private $connection;

    private function __construct() {
        self::$instance = $this;
        $this->connection = mysqli_connect('localhost', 'root', '', 'jilo');
        if (!$this->connection) {
            throw new Exception('Database.php connection error: ' . mysqli_connect_error($this->connection));
        }
    }

    final public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($query) {
        $result = mysqli_query($this->connection, $query);
        if (mysqli_error($this->connection) != '') {
            throw new Exception('Database.php connection error: ' . mysqli_connect_error($this->connection));
        }
        return $result;
    }

    /**
     * @return mysqli
     */
    public function getConnection() {
        return $this->connection;
    }



}

?>