<?php
/**
 * Created by PhpStorm.
 * User: Davit
 * Date: 04/04/17
 * Time: 15:56
 */


$connection = mysqli_connect('localhost', 'root', '', 'jilo');
if (!$connection) {
    die("Database connection failed");
}
$query = "select * from users";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("Wasn't able to insert new user with error " . mysqli_error($connection));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<table>
    <thead>
    <tr><th>Username</th></tr>
    </thead>
    <tbody>
<?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['login']}</td>
                <td>{$row['activated']}</td>
                <td><button><span>Update</span></button></td>
                <td><button><span>Delete</span></button></td>
              </tr>";
    }
?>
    </tbody>

</table>

</body>


</html>