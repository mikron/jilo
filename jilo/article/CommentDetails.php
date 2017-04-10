<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/CommentDB.php';
$commentDB = new CommentDB();
if (isset($_GET['article'])) {
    $articleId = $_GET['article'];
}

if (isset($_POST['add'])) {
    $articleId = $_POST['articleId'];
    $text = $_POST['text'];
    $activated = $_POST['activated'];
    if (!isset($activated)) {
        // TODO some enum for YESNO
        $activated = 0;
    }

    if ($text && $activated) {
        $commentDB->insertComment($articleId, $text, $activated);
        header('Location: ArticleDetails.php?id=' . $articleId . '&viewmode=true');
    } else {
        echo "Title, text and activated are required!";
    }
}

$title = "Edit comment";
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Header.php';
?>

<form action="CommentDetails.php" method="post">
    <input type="hidden" name="articleId" value="<?php echo $articleId; ?>">
    <input type="text" name="text" placeholder="Text">
    <?php
    if (isset($_SESSION['ROLEADMIN']) && $_SESSION['ROLEADMIN'] == true) {
        echo "<select type=\"text\" name=\"activated\" placeholder=\"Activated\">
        <option value=\"1\">Yes</option>
        <option value=\"0\">No</option>
    </select>";
    };
    ?>
    <input type="submit" value="Add" name="add">
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>
