<?php
require_once 'Database.php';

class ArticleDB {

    public function __construct() {
    }

    public function findAll($roleIsAdmin) {
        $query = "SELECT * FROM article";
        if (isset($roleIsAdmin) && $roleIsAdmin == true) {
            echo "ADMIN";
        } else {
            $query = $query . " WHERE activated = 1 ";
        }
        return Database::getInstance()->query($query);
    }

    public function findOneById($id) {
        $query = "SELECT * FROM article WHERE id = $id";
        return Database::getInstance()->query($query);
    }

    public function setActivated($id, $activated) {
        $query = "UPDATE article SET activated = $activated WHERE id = $id";
        Database::getInstance()->query($query);
    }

    public function insertArticle($title, $text, $activated) {
        $query = "INSERT INTO article(title, text, activated) VALUES ('{$title}', '{$text}', $activated)";
        Database::getInstance()->query($query);
        /*$mysqli = Database::getInstance();
        $mysqli->query($query);
        $this->findOneById(mysqli_insert_id($mysqli->getConnection()));*/
    }

    public function updateArticle($id, $title, $text, $activated) {
        $query = "UPDATE article SET title = '{$title}', text = '{$text}', activated = $activated WHERE id = $id";
        Database::getInstance()->query($query);
        /*$mysqli = Database::getInstance();
        $mysqli->query($query);
        echo  mysqli_insert_id($mysqli->getConnection());
        $this->findOneById(mysqli_insert_id($mysqli->getConnection()));*/
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM article WHERE id = $id";
        Database::getInstance()->query($query);
    }

}

?>
