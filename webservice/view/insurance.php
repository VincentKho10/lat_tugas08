<fieldset>
    <legend>
        manipulasi data
    </legend>
    <form method="post">
        <label for="name">name class: </label>
        <input type="text" id="name" name="name_class">
        <button type="submit" name="addBtnClicked">add</button>
    </form>
</fieldset>

<table id="myTable">
    <thead>
    <tr>
        <th>id</th>
        <th>nama class</th>
        <th>action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /* @var Insurance $insurance*/
    foreach($insurances as $insurance)
    {
        echo"<tr>";
        echo"<td>". $insurance->getId() ."</td>";
        echo"<td>". $insurance->getNameClass() ."</td>";
        echo"<td><button onclick='updateInsurance(". $insurance->getId() .")'>update</button><button onclick='delInsurance(". $insurance->getId() .")'>delete</button></td>";
        echo"</tr>";
    }
    ?>
    </tbody>
</table>