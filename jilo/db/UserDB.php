<?php
require_once 'Database.php';

// TODO clear input parameters for SQL Injection
// TODO encrypt password
class UserDB {

    public function __construct() {
    }

    public function findAll() {
        $query = "SELECT * FROM users";//INNER JOIN user_athority WHERE users.id = user_authority.user_id
        return Database::getInstance()->query($query);
    }

    public function findOneByLogin($username) {
        $query = "SELECT * FROM users WHERE login = '{$username}'";
        return Database::getInstance()->query($query);
    }

    public function setActivated($username, $activated) {
        $query = "UPDATE users SET activated = $activated WHERE login = '{$username}'";
        Database::getInstance()->query($query);
    }

    public function insertUser($username, $password, $role) {
        $query = "INSERT INTO users(login, password, activated) VALUES ('{$username}', '{$password}', 1)";
        Database::getInstance()->query($query);
    }

    public function deleteUserByLogin($username) {
        $query = "DELETE FROM users WHERE login = '{$username}'";
        Database::getInstance()->query($query);
    }

    public function getRoles() {
        $query = "SELECT * FROM authority";
        return Database::getInstance()->query($query);
    }

    public function getAuthorityByUserId($userId) {
        $query = "SELECT * FROM user_authority WHERE id = $userId";
        return Database::getInstance()->query($query);
    }

    public function hasAuthority($userId) {
        $query = "SELECT * FROM user_authority WHERE id = $userId and authority_id > 0";
        return Database::getInstance()->query($query);
    }

    public function hasAdminAuthority($userId) {
        $query = "SELECT * FROM user_authority WHERE user_id = $userId and authority_id = 1";
        return Database::getInstance()->query($query);
    }

}

?>