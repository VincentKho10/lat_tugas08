<fieldset>
    <legend>
        manipulasi data
    </legend>
    <form method="post">
        <label for="name">name class: </label>
        <?php
            /* @var Insurance $ins*/
            echo '<input type="text" id="name" name="name_class" value="'.$ins->getNameClass().'">';
        ?>
        <button type="submit" name="btnUpdateDown">update</button>
    </form>
</fieldset>