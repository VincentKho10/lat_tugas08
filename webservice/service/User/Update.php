<?php
include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Util/DBHelper.php";

$updated=filter_input(0,"btnUpd");
if(isset($updated)) {
    
    $id = filter_input(0, "id");
    $pass = filter_input(0, "pass");
    $user = new User();
    $user->setId($id);
    $usrd = new UserDao();

    header("Content-Type:application/json");
    if ($usrd->updUser($user)) {
        echo json_encode(array("Message" => "User added successfully"));
    } else {
        echo json_encode(array("Message" => "fail adding User"));
    }
}