<?php
include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Util/DBHelper.php";

$id = filter_input(INPUT_GET,"id");
$usr = new User();
$usr->setId($id);
$usrd = new UserDao();

header("Content-Type: application/json");
$User = $usrd->getOneUser($usr);
if(!empty($User)){
    echo json_encode(array("Name"=>$User->getName(),"role"=>$User->getName()));
}else{
    echo json_encode(array("Message"=>"fail returning User"));
}
