<?php
require_once 'Database.php';

class ArticleDB {

    public function __construct() {
    }

    public function findAll() {
        $query = "SELECT * FROM article WHERE activated = 1";
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
    }

    public function updateArticle($id, $title, $text, $activated) {
        $query = "UPDATE article SET title = '{$title}', text = '{$text}', activated = $activated WHERE id = $id";
        Database::getInstance()->query($query);
    }

    public function deleteArticle($id) {
        $query = "DELETE FROM article WHERE id = $id";
        Database::getInstance()->query($query);
    }

}

?>
