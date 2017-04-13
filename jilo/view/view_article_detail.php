<form action="" method="post">
    <fieldset disabled>
        <input type="text" name="title" placeholder="Title" value="<?php echo $data['title']; ?>">
        <input type="text" name="text" placeholder="Text" value="<?php echo $data['text']; ?>">
        <select>
            <option value=\"1\">Yes</option>
            <option value=\"0\">No</option>
        </select>
        <input type="submit" value="Add" name="add">
    </fieldset>
</form>
