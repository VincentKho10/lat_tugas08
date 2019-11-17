<?php
include_once "../../db_function/InsuranceDao.php";
include_once "../../Entity/Insurance.php";
include_once "../../Util/DBHelper.php";

$id = filter_input(INPUT_GET,"id");
$ins = new Insurance();
$ins->setId($id);
$insd = new InsuranceDao();

header("Content-Type: application/json");
$insurance = $insd->getOneInsurance($ins);
if(!empty($insurance)){
    echo json_encode(array("NameClass"=>$insurance->getNameClass()));
}else{
    echo json_encode(array("Message"=>"fail returning insurance"));
}