<?php
session_start();

echo $_SESSION['LOGGEDIN'];

if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
    header('Location: article/Article.php');
} else {
    header('Location: user/Login.php');
}

?>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jilo</title>
    <base href="http://localhost.com/jilogit/jilo" />
</head>
<body>
<p>Empty body</p>
</body>
</html>-->