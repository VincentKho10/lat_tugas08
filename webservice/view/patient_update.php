<?php

?>

<fieldset>
    <lengend>update pasien</lengend>
    <form method="post" enctype="multipart/form-data">
        <label for="citidnum">citizen id number:</label><br>
        <?php
        /* @var Patient $mrns*/
            echo'<input type="text" id="citidnum" name="cidn" value="'.$mrns->getCitizenIdNumber().'">';
        ?>
        <br>

        <label for="name">name:</label><br>
        <?php
        echo '<input type="text" id="name" name="nme" value="'.$mrns->getName().'">';
        ?>
        <br>

        <label for="addr">address:</label><br>
        <?php
            echo '<input type="text" id="addr" name="adr" value="'.$mrns->getAddress().'">';
        ?>
        <br>

        <label for="bipl">birth place:</label><br>
        <?php
            echo '<input type="text" id="bipl" name="bhp" value="'.$mrns->getBirthPlace().'">';
        ?>
        <br>

        <label for="bida">birth date:</label><br>
        <?php
            echo '<input type="date" id="bida" name="bhd" value="'.$mrns->getBirthDate().'">';
        ?>
        <br>

        <label for="phnum">phone number:</label><br>
        <?php
            echo '<input type="text" id="phnum" name="phn" value="'.$mrns->getPhoneNumber().'">';
        ?>
        <br>

        <label for="phto">photo:</label><br>
        <?php
            echo '<input type="file" id="phto" name="pto" value="'.$mrns->getPhoto().'">';
        ?>
        <br>

        <label for="insurance">insurance:</label><br>
        <select id="insurance" name="ins">
            <?php
            /* @var Insurance $item*/
            foreach ($insurances as $item) {
                if($item->getId()==$mrns->getInsurance()){
                    echo "<option value='".$item->getNameClass()."' selected>".$item->getNameClass()."</option>";
                }else{
                    echo "<option value='".$item->getId()."'>".$item->getNameClass()."</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="btnPatClicked">update</button>
    </form>
</fieldset>
