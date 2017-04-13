<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 16:03
 */
class Controller_Article extends Controller {

    private $modelArticle;

    /**
     * Controller_Article constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->modelArticle = new Model_Article();
    }

    function action_index() {
        $this->view->generate('view_article.php', 'template_view.php', $this->modelArticle->get_articles());
    }

    function action_view() {
        $id = end(explode('/', $_SERVER['REQUEST_URI']));
        $this->view->generate('view_article_detail.php', 'template_view.php', $this->modelArticle->get_article($id));
    }

    function action_edit() {
        $id = end(explode('/', $_SERVER['REQUEST_URI']));
        $this->modelArticle->edit();
        Route::redirect('article');
    }

    function action_delete() {
        $id = end(explode('/', $_SERVER['REQUEST_URI']));
        $this->modelArticle->delete($id);
        Route::redirect('article');
    }

}