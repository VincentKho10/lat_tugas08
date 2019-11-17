<?php
include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Util/DBHelper.php";

$deleted=filter_input(1,"id");
$usr = new User();
$usr->setNameClass($name);
$usrd = new UserDao();

header("Content-Type:application/json");
if($usrd->delUser($usr)){
    echo json_encode(array("Message"=>"User added successfully"));
}else{
    echo json_encode(array("Message"=>"fail adding User"));
}
