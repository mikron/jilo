<?php
session_start();

require_once 'model/model.php';
require_once 'view/view.php';
require_once 'controller/controller.php';

require_once 'route.php';
Route::start();

