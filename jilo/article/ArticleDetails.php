<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/db/ArticleDB.php';
$articleDB = new ArticleDB();

if (isset($_GET['id'])) {
    $row = $articleDB->findOneById($_GET['id'])->fetch_assoc();
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
    <input type="text" name="title" placeholder="Title" value="<?php echo isset($row) ? htmlspecialchars($row['title']) : ""; ?>">
    <input type="text" name="text" placeholder="Text" value="<?php echo isset($row) ? htmlspecialchars($row['text']) : ""; ?>">
    <select type="text" name="activated" placeholder="Activated" value="<?php echo isset($row) ? htmlspecialchars($row['activated']) : ""; ?>">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    <input type="submit" value="<?php echo isset($row) ? "Update" : "Add"; ?>" name="add">
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/jilogit/jilo/layout/Footer.php'; ?>
