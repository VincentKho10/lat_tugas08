<?php
include_once "../../db_function/PatientDao.php";
include_once "../../Entity/Patient.php";
include_once "../../Util/DBHelper.php";

$btnPatClicked = filter_input(0,"btnPatClicked");
if(isset($btnPatClicked)) {
    $mrn = filter_input(0, "mrn");
    $cidn = filter_input(0, "cidn");
    $nme = filter_input(0, "nme");
    $addr = filter_input(0, "adr");
    $bhp = filter_input(0, "bhp");
    $bhd = filter_input(0, "bhd");
    $phn = filter_input(0, "phn");
    $namafile = $mrn;
    if (($_FILES['pto']['name'] == null) == 1) {
        echo "kolom file kosong";
        $pto = "";
    } else {
        $namasementara = $_FILES['pto']['tmp_name'];
        $dirupload = "upload/";
        move_uploaded_file($namasementara, $dirupload . $namafile);
        $pto = $dirupload . $namafile;
    }
    $ins = filter_input(0, "ins");
    $patobj = new Patient();
    $patobj->setMedRecordNumber($mrn);
    $patobj->setCitizenIdNumber($cidn);
    $patobj->setName($nme);
    $patobj->setAddress($addr);
    $patobj->setBirthPlace($bhp);
    $patobj->setBirthDate($bhd);
    $patobj->setPhoneNumber($phn);
    $patobj->setPhoto($pto);
    $patobj->setInsurance($ins);
    $insd = new PatientDao();

    header("Content-Type:application/json");
    if ($insd->addPatient($patobj)) {
        echo json_encode(array("Message" => "Patient added successfully"));
    } else {
        echo json_encode(array("Message" => "fail adding Patient"));
    }
}