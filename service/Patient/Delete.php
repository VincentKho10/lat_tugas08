<?php
include_once "../../db_function/PatientDao.php";
include_once "../../Entity/Patient.php";
include_once "../../Util/DBHelper.php";

$deleted = filter_input(1,"mrn");
if(isset($deleted)) {
    $patobj = new Patient();
    $patobj->setMedRecordNumber($deleted);
    $pat = $this->patientDao->getOnePatient($patobj);
    unlink($pat->getPhoto());
    $insd = new PatientDao();

    header("Content-Type:application/json");
    if ($insd->delPatient($patobj)) {
        echo json_encode(array("Message" => "Patient added successfully"));
    } else {
        echo json_encode(array("Message" => "fail adding Patient"));
    }
}