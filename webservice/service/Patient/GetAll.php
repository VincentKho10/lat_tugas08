<?php

include_once "../../db_function/PatientDao.php";
include_once "../../Entity/Patient.php";
include_once "../../Util/DBHelper.php";

$insd = new PatientDao();

header("Content-Type: application/json");
$Patients = $insd->getAllPatient();
if(!empty($Patients)) {
    $result = array();
    foreach ($Patients as $Patient) {
        array_push($result,
            array(
                "id" => $Patient->getId(),
                "NameClass" => $Patient->getNameClass()
            )
        );
    }
    echo json_encode($result);
}else{
    echo json_encode(array("Message"=>"fail returning Patient"));
}
