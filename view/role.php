<fieldset>
    <legend>manipulate data</legend>
    <form method="POST">
        <label for="inpName">name:</label><br>
        <input type="text" id="inpName" name="Name"><br>
        <br>
        <button type="submit" name="btnAdd">add</button>
    </form>
</fieldset>

<table id="myTable">
    <thead>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>Action</td>
    </tr>
    </thead>

    <tbody>
    <?php
    /* @var Role $role*/
    foreach ($roles as $role){
        $rlestrg = "'".$role->getId()."'";
        var_dump($rlestrg);
        echo '<tr>'
            .'<td>'.$role->getId().'</td>'
            .'<td>'.$role->getName().'</td>'
            .'<td><button onclick="rleUpdate('.$rlestrg.')">update</button>'
            .'<button onclick="rleDelete('.$rlestrg.')">delete</button></td>'
            .'</tr>';
    }
    ?>
    </tbody>
</table>