<?php
include_once "../../db_function/InsuranceDao.php";
include_once "../../Entity/Insurance.php";
include_once "../../Util/DBHelper.php";

$name = filter_input(INPUT_POST,"class_name");
$ins = new Insurance();
$ins->setNameClass($name);
$insd = new InsuranceDao();

header("Content-Type:application/json");
if($insd->addInsurance($ins)){
    echo json_encode(array("Message"=>"Insurance added successfully"));
}else{
    echo json_encode(array("Message"=>"fail adding insurance"));
}
