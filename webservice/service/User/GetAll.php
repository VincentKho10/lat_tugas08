<?php

include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Entity/Role.php";
include_once "../../Util/DBHelper.php";

$insd = new UserDao();

$Users = $insd->getAllUser();
if(!empty($Users)) {
    $result = array();
    foreach ($Users as $User) {
        array_push($result,
            array(
                "Name"=>$User->getName(),
                "Role"=>$User->getRole()->getId()
            )
        );
    }
    header("Content-Type: application/json");
    echo json_encode($result);
}else{
    echo json_encode(array("Message"=>"fail returning User"));
}
