<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/ArticleDB.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/CommentDB.php';
$articleDB = new ArticleDB();
$commentDB = new CommentDB();
$articleId;

$viewmode = false;
if (isset($_GET['id'])) {
    $articleId = $_GET['id'];
    $row = $articleDB->findOneById($_GET['id'])->fetch_assoc();
    $commentResult = $commentDB->findAll($_GET['id']);
}
if (isset($_GET['viewmode'])) {
    $viewmode = $_GET['viewmode'];
}

if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $text = $_POST['text'];
    $activated = $_POST['activated'];

    if ($title && $text && $activated) {
        echo isset($row) ? "isset" : "something got wrong";
        if (isset($row)) {
            $articleDB->updateArticle($row['id'], $title, $text, $activated);
        } else {
            $articleDB->insertArticle($title, $text, $activated);
        }
        header('Location: Article.php');
    } else {
        echo "Title, text and activated are required!";
    }
}

$title = "Add article";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';
?>

<form action="<?php echo isset($row) ? "ArticleDetails.php?id=" . $row['id'] : "ArticleDetails.php"; ?>" method="post">
    <fieldset <?php echo $viewmode == true ? "disabled" : ""; ?>>
        <input type="text" name="title" placeholder="Title" value="<?php echo isset($row) ? htmlspecialchars($row['title']) : ""; ?>">
        <input type="text" name="text" placeholder="Text" value="<?php echo isset($row) ? htmlspecialchars($row['text']) : ""; ?>">
        <select type="text" name="activated" placeholder="Activated" value="<?php echo isset($row) ? htmlspecialchars($row['activated']) : ""; ?>">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
        <input type="submit" value="<?php echo isset($row) ? "Update" : "Add"; ?>" name="add">
    </fieldset>
</form>

<?php
if ($viewmode == true) {
    echo "<h3>Comments</h3><table><thead><tr><th>Text</th></tr></thead><tbody>";
    echo "<input type=\"button\" onclick=\"location.href='CommentDetails.php?article=" . $articleId . "'\" value=\"Add\" />";
    while ($row = mysqli_fetch_assoc($commentResult)) {
        echo "<tr>
                    <td>{$row['text']}</td>
                  </tr>";
    }
    echo "</tbody></table>";
}

?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>
