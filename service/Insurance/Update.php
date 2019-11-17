<?php
include_once "../../db_function/InsuranceDao.php";
include_once "../../Entity/Insurance.php";
include_once "../../Util/DBHelper.php";

$id = filter_input(1,'id');
$name = filter_input(0,"name_class");
$ins = new Insurance();
$ins->setNameClass($name);
$ins->setId($id);
$insd = new InsuranceDao();

header("Content-Type:application/json");
if($insd->updInsurance($ins)){
    echo json_encode(array("Message"=>"Insurance added successfully"));
}else{
    echo json_encode(array("Message"=>"fail adding insurance"));
}
