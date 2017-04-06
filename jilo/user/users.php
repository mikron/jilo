<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/UserDB.php';
$userDB = new UserDB();
$result = $userDB->findAll();

$title = "Users";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';
?>
<table>
    <thead>
    <tr>
        <th>Username</th>
        <th>Activated</th>
    </tr>
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

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>