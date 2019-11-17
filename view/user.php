<?php
?>

<fieldset>
    <legend>manipulate data</legend>
    <form method="post">
        <label for="inpName">name:</label><br>
        <input type="text" id="inpName" name="Name"><br>
        <br>

        <label for="slcrole">Role:</label><br>
        <select name="role" id="slcrole">
            <?php
            /* @var Role $item*/
            foreach ($role as $item) {
                echo "<option value='".$item->getId()."'>".$item->getName()."</option>";
            }
            ?>
        </select>
        <button type="submit" name="btnAdd">add</button>
    </form>
</fieldset>

<table id="myTable">
    <thead>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>Role</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user){
        $usrstrg = "'".$user->getId()."'";
        echo '<tr>'
            .'<td>'.$user->getId().'</td>'
            .'<td>'.$user->getName().'</td>'
            .'<td>'.$user->getRole()->getName().'</td>';
            if($user->getPassword()==null){
                echo '<td><form method="POST">'
                    .'<input type="password" name="id" value="'.$user->getId().'" hidden>'
                    .'<input type="password" name="pass" placeholder="password">'
                    .'<input type="password" name="confpass" placeholder="confirm password">'
                    .'<button name="btnUpd">update</button></form>';
            }else{
                echo'<td>';
            }
            echo '<button onclick="usrDelete('.$usrstrg.')">delete</button></td>'
            .'</tr>';
    }
    ?>
    </tbody>
</table>