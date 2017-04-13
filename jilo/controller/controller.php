<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 14:30
 */
class Controller {
    public $model;
    public $view;

    function __construct() {
        $this->view = new View();
    }

    function action_index() {
        // TODO abstract or not abstract
    }

}