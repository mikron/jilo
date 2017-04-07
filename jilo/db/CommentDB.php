<?php
require_once 'Database.php';

class CommentDB {

    public function __construct() {
    }

    public function findAll($articleId) {
        $query = "SELECT * FROM comments WHERE article_id = $articleId";
        return Database::getInstance()->query($query);
    }

    public function findOneById($id) {
        $query = "SELECT * FROM comments WHERE id = $id";
        return Database::getInstance()->query($query);
    }

    public function setActivated($id, $activated) {
        $query = "UPDATE comments SET activated = $activated WHERE id = $id";
        Database::getInstance()->query($query);
    }

    public function insertComment($articleId, $text, $activated) {
        $query = "INSERT INTO comments(article_id, text, activated) VALUES ($articleId, '{$text}', $activated)";
        Database::getInstance()->query($query);
    }

    public function deleteComment($id) {
        $query = "DELETE FROM comments WHERE id = $id";
        Database::getInstance()->query($query);
    }

}

?>