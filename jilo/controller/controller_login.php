<?php

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 15:01
 */
class Controller_Login extends Controller {

    private $modelLogin;

    /**
     * Controller_Login constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->modelLogin = new Model_Login();
    }

    function action_index() {
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($username && $password) {

                if ($this->modelLogin->chkLogin($username, $password)) {
                    echo "Succesfull login";
                    Route::redirect('article', null);
                } else {
                    echo "Username or password are wrong!";
                }
            } else {
                echo "Username and password are required!";
            }
        }

        $this->view->generate('view_login.php', 'template_view.php', $this->modelLogin->get_data());
    }

    function action_logout() {
        $this->modelLogin->logout();
        Route::redirect('login', 'index');
    }

}