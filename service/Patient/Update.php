<?php
include_once "../../db_function/PatientDao.php";
include_once "../../Entity/Patient.php";
include_once "../../Util/DBHelper.php";


$updated=filter_input(0,"btnPatClicked");
$mrn=filter_input(1,"mrn");
if(isset($updated)) {
    $cidn = filter_input(0, "cidn");
    $nme = filter_input(0, "nme");
    $addr = filter_input(0, "adr");
    $bhp = filter_input(0, "bhp");
    $bhd = filter_input(0, "bhd");
    $phn = filter_input(0, "phn");
    $ins = filter_input(0, "ins");
    $namafile = $mrn;
    if (($_FILES['pto']['name'] == null) == 1) {
        echo "kolom file kosong";
    } else {
        $namatemp = $_FILES['pto']['tmp_name'];
        $namadir = "upload/";
        unlink($namatemp, $namadir . $namafile);
        move_uploaded_file($namatemp, $namadir . $namafile);
        $pto = $namadir . $namafile;
    }
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
    if ($insd->updPatient($patobj)) {
        echo json_encode(array("Message" => "Patient updated successfully"));
    } else {
        echo json_encode(array("Message" => "fail updateing Patient"));
    }
}