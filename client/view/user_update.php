<?php


?>

<fieldset>

    <legend>manipulate data</legend>

    <form method="post">
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
                        echo '<td><input type="password" name="pass" placeholder="password">'
                        .'<input type="password" name="confpass" placeholder="confirm password"></td>';
                    }
                    echo '</tr>';
            }
        ?>
            </tbody></table>
        <button type="submit" name="btnUpd">update</button>
    </form>

</fieldset>