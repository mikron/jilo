<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 16:41
 */
class Controller_404 extends Controller {

    function action_index() {
        $this->view->generate('view_404.php', 'template_view.php');
    }


}