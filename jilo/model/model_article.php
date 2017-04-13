<?php
include Route::getDatabaseFile('ArticleDB.php');
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 17:23
 */
class Model_Article extends Model {

    private $articleDB;

    function __construct() {
        $this->articleDB = new ArticleDB();
    }

    public function get_articles() {
        if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
        } else {
            Route::redirect('login');
        }
        $result = $this->articleDB->findAll($_SESSION['ROLEADMIN']);
        return $result;
    }

    public function get_article($id) {
        return $this->articleDB->findOneById($id)->fetch_assoc();
    }

    public function save() {
        if (isset($_POST)) {
            // Logout
            if (isset($_POST['logout_event']) && $_POST['logout_event'] == true) {
                $_SESSION['LOGGEDIN'] = false;
                $_SESSION['USERID'] = '';
                Route::redirect('login');
            }
        }
    }

    public function view() {

    }

    public function edit() {

    }

    public function delete($id) {
        $this->articleDB->deleteArticle($id);
    }

}