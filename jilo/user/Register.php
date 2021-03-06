<?php @E_USER_DEPRECATED; ?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/UserDB.php';
$userDB = new UserDB();

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    echo $username . $password . $role;

    if ($username && $password && $role) {
       $userDB->insertUser($username, $password, $role);
    } else {
        echo "Username, Password and Role are required!";
    }
}

$title = "Register";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';
?>
<form action="Register.php" method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <select type="text" name="role" placeholder="Role">
        <?php
            foreach ($userDB->getRoles() as $role) {
                echo "<option value={$role['id']}>{$role['name']}</option>";
            }
        ?>
    </select>
    <a href="Login.php">Already have account?</a>
    <input type="submit" value="Register" name="register">
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>
