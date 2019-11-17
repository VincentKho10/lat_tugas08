<?php

include_once "../../db_function/InsuranceDao.php";
include_once "../../Entity/Insurance.php";
include_once "../../Util/DBHelper.php";

$insd = new InsuranceDao();

header("Content-Type: application/json");
$insurances = $insd->getAllInsurance();
if(!empty($insurances)) {
    $result = array();
    foreach ($insurances as $insurance) {
        array_push($result,
            array(
                "id" => $insurance->getId(),
                "NameClass" => $insurance->getNameClass()
            )
        );
    }
    echo json_encode($result);
}else{
    echo json_encode(array("Message"=>"fail returning insurance"));
}