<?php
include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Util/DBHelper.php";

$btnAdd = filter_input(0,"btnAdd");
if(isset($btnAdd)) {
    $nme = filter_input(0, "Name");
    $rle = filter_input(0, "role");
    $user = new User();
    $user->setName($nme);
    $user->setRole($rle);

    $usrd = new UserDao();

    header("Content-Type:application/json");
    if ($usrd->addUser($user)) {
        echo json_encode(array("Message" => "User added successfully"));
    } else {
        echo json_encode(array("Message" => "fail adding User"));
    }
}