<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 04/04/17
 * Time: 11:35
 */
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/UserDB.php';
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $userDB = new UserDB();
        $row = $userDB->findOneByLogin($username)->fetch_assoc();
        if ($row['password'] === $password) {
            $_SESSION['USERID'] = $row['id'];
            header("Location: ../index.php");
        } else {
            new Exception("Wrong login or password");
        }
    } else {
        echo "Username and password are required!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="Login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="login">
    </form>
</body>


</html>