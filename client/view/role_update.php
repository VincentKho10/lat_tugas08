<?php

?>

<fieldset>
    <legend>manipulate data</legend>

    <form method="post">
        <label for="inpName">name:</label><br><?php
        echo '<input type="text" id="inpName" name="Name" value="'.$role->getName().'"><br>'?>
        <br>
        <button type="submit" name="btnUpd">update</button>
    </form>

</fieldset>