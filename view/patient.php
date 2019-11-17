<?php
?>

<fieldset>
    <legend>manipulate data</legend>
    <form method="post" enctype="multipart/form-data">
        <label for="medrecnum">med record number:</label><br>
        <input type="text" id="medrecnum" name="mrn">
        <br>
        <label for="citidnum">citizen id number:</label><br>
        <input type="text" id="citidnum" name="cidn">
        <br>
        <label for="name">name:</label><br>
        <input type="text" id="name" name="nme">
        <br>
        <label for="addr">address:</label><br>
        <input type="text" id="addr" name="adr">
        <br>
        <label for="bipl">birth place:</label><br>
        <input type="text" id="bipl" name="bhp">
        <br>
        <label for="bida">birth date:</label><br>
        <input type="date" id="bida" name="bhd">
        <br>
        <label for="phnum">phone number:</label><br>
        <input type="text" id="phnum" name="phn">
        <br>
        <label for="phto">photo:</label><br>
        <input type="file" id="phto" name="pto">
        <br>
        <label for="insurance">insurance:</label><br>
        <select id="insurance" name="ins">
        <?php
        /* @var Insurance $item*/
        foreach ($insurances as $item) {
            echo "<option value='".$item->getId()."'>".$item->getNameClass()."</option>";
        }
        ?>
        </select>
        <button type="submit" name="btnPatClicked">add</button>
    </form>
</fieldset>

<table id="myTable">
    <thead>
    <tr>
        <td>med record number</td>
        <td>citizen id number</td>
        <td>name</td>
        <td>address</td>
        <td>birth place</td>
        <td>birth date</td>
        <td>phone number</td>
        <td>photo </td>
        <td>insurance</td>
        <td>action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    /* @var Patient $patient*/
    foreach ($patients as $patient){
        $patstrg = "'".$patient->getMedRecordNumber()."'";
        echo '<tr>'
        .'<td>'.$patient->getMedRecordNumber().'</td>'
        .'<td>'.$patient->getCitizenIdNumber().'</td>'
        .'<td>'.$patient->getName().'</td>'
        .'<td>'.$patient->getAddress().'</td>'
        .'<td>'.$patient->getBirthPlace().'</td>'
        .'<td>'.$patient->getBirthDate().'</td>'
        .'<td>'.$patient->getPhoneNumber().'</td>'
        .'<td><img src="'.$patient->getPhoto().'"></td>'
        .'<td>'.$patient->getInsurance()->getNameClass().'</td>'
        .'<td><button onclick="patDelete('.$patstrg.')">delete</button>';
        if($_SESSION['logged_as']!="Registration Officer"){
            echo '<button onclick="patUpdate('.$patstrg.')">update</button></td>';
        }else{
            echo '</td>';
        }
        echo '</tr>';

    }
    ?>
    </tbody>
</table>
<?php
