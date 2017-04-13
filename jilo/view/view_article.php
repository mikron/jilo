<h1>Articles</h1>
<input type="button" onclick="location.href='<?php echo Route::getHost(). 'login/logout';  ?>'" value="Add" />
<br/>
<input type="button" onclick="location.href='<?php echo Route::getHost(). 'login/logout';  ?>'" value="Logout" />
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
    while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['text']}</td>
                    <td><input type='button' value='View' onclick=\"location.href='" . Route::getHost(). "article/view/{$row['id']}'\"/></td>
                    <td><input type='button' value='Edit' onclick=\"location.href='" . Route::getHost(). "article/edit/{$row['id']}'\"/></td>";
        if (isset($_SESSION['ROLEADMIN']) && $_SESSION['ROLEADMIN'] == true) {
            echo " <td><input type='button' value='Delete' onclick=\"location.href='" . Route::getHost(). "article/delete/{$row['id']}'\"/></td>";
        }
        echo "  </tr>";
    }
    ?>
    </tbody>
</table>