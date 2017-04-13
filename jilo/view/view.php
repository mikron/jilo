<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 14:30
 */
class View {

    function generate($content_view, $template_view, $data = null) {
        include 'view/'.$template_view;
    }

}