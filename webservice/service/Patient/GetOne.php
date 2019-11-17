<?php
include_once "../../db_function/PatientDao.php";
include_once "../../Entity/Patient.php";
include_once "../../Util/DBHelper.php";

$mrn=filter_input(1,"mrn");
if(isset($mrn)) {
    $patobj = new Patient();
    $patobj->setMedRecordNumber($mrn);
    $insd = new PatientDao();

    header("Content-Type: application/json");
    $Patient = $insd->getOnePatient($patobj);
    if (!empty($Patient)) {
        echo json_encode(array("NameClass" => $Patient->getNameClass()));
    } else {
        echo json_encode(array("Message" => "fail returning Patient"));
    }
}