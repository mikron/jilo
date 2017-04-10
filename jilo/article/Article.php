<?php
session_start();
if (isset($_SESSION['LOGGEDIN']) && $_SESSION['LOGGEDIN'] == true) {
} else {
    header('Location: ../user/Login.php');
}

include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/ArticleDB.php';
$articleDB = new ArticleDB();
$result = $articleDB->findAll($_SESSION['ROLEADMIN']);

$title = "Article";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';

if (isset($_POST)) {
    // Delete by id
    if (isset($_POST['delete_id'])) {
        $articleDB->deleteArticle($_POST['delete_id']);
    }
    // Logout
    if (isset($_POST['logout_event']) && $_POST['logout_event'] == true) {
        $_SESSION['LOGGEDIN'] = false;
        $_SESSION['USERID'] = '';
        header("Location: ../user/Login.php");
    }
}

?>
<h1>Add new Articles</h1>
<input type="button" onclick="location.href='ArticleDetails.php'" value="Add" />
<br/>
<form><button class='logoutbtn''>Logout</button></form>
<h1>Articles</h1>
<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Text</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['text']}</td>
                    <td><button class='viewbtn' value='{$row['id']}'>View</button></td>
                    <td><button class='editbtn' value='{$row['id']}'>Edit</button></td>";
                if (isset($_SESSION['ROLEADMIN']) && $_SESSION['ROLEADMIN'] == true) {
                    echo " <td><button class='deletebtn' value='{$row['id']}'>Delete</button></td>";
                }
                echo "  </tr>";
            }
        ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $(".viewbtn").click(function() {
            window.location = window.location.toString().replace(/article.php/ig, 'ArticleDetails.php?id=' + $(this).attr("value") + '&viewmode=true');
            console.log('Edit button click ' + $(this).attr("value"));
        });
        $(".editbtn").click(function() {
            window.location = window.location.toString().replace(/article.php/ig, 'ArticleDetails.php?id=' + $(this).attr("value"));
            console.log('Edit button click ' + $(this).attr("value"));
        });
        $('.deletebtn').click(function(){
            $.post("Article.php", {delete_id: $(this).attr("value")}, function () {
                // TODO refresh only when action was succesfull
                window.location.reload();
            });
            console.log('Delete button click' + $(this).attr("value"));
        });
        $(".logoutbtn").click(function() {
            $.post("Article.php", {logout_event: 1});
            console.log('Logout button click');
        });
    });
</script>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>