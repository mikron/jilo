<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 04/04/17
 * Time: 11:35
 */

if (isset($_POST['login'])) {

    $users = Array('admin', 'user');

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $connection = mysqli_connect('localhost', 'root', '', 'jilo');
        if ($connection) {
            echo "Connection was succesfull!";
        } else {
            die("Database connection failed");
        }
    } else {
        echo "Username and password are required!";
    }

    $query = "INSERT INTO users(login, password) VALUES ('{$username}', '{$password}')";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die("Wasn't able to insert new user with error " . mysqli_error($connection));
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
    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="login">
    </form>
</body>


</html>