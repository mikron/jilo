<?php @E_USER_DEPRECATED; ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/UserDB.php';
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username && $password) {
        $userDB = new UserDB();
        $row = $userDB->findOneByLogin($username)->fetch_assoc();
        if ($row['password'] === $password) {
            $_SESSION['LOGGEDIN'] = true;
            $_SESSION['USERID'] = $row['id'];
            $_SESSION['ROLEADMIN'] = $userDB->hasAuthority($row['id'], 1)->num_rows > 0;
            echo "Succesfull login";
            header("Location: ../index.php");
        } else {
            echo "Username and password are required!";
        }
    } else {
        echo "Username and password are required!";
    }
}


$title = "Login";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';
?>

    <form action="Login.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <a href="Register.php">Don't have account?</a>
        <input type="submit" name="login">
    </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>