<?php
include Route::getDatabaseFile('UserDB.php');

/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 12/04/17
 * Time: 15:02
 */
class Model_Login extends model {

    public function get_data() {
        // TODO: Implement get_data() method.
        return Array("echo" => "Model_Login" . ".get_data()");
    }

    public function chkLogin($username, $password) {
        $userDB = new UserDB();
        $row = $userDB->findOneByLogin($username)->fetch_assoc();
        if ($row['password'] === $password) {
            $_SESSION['LOGGEDIN'] = true;
            $_SESSION['USERID'] = $row['id'];
            $_SESSION['ROLEADMIN'] = $userDB->hasAuthority($row['id'], 1)->num_rows > 0;
            return true;
        } else {
            $this->logout();
            return false;
        }
    }

    public function logout() {
        unset($_SESSION['LOGGEDIN']);
        unset($_SESSION['USERID']);
        unset($_SESSION['ROLEADMIN']);
    }

}