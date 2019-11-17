<?php
include_once "../../db_function/UserDao.php";
include_once "../../Entity/User.php";
include_once "../../Util/DBHelper.php";

$login = filter_input(0,"btnLogin");
if(isset($login)) {
    $uname = filter_input(0, "Uname");
    $pass = filter_input(0, "Pass");
    $usr = new User();
    $usr->setUsername($uname);
    $usr->setPassword($pass);
    $usrd = new UserDao();

    header("Content-Type: application/json");
    $User = $usrd->loginUser($usr);
    if (!empty($User)) {
        echo json_encode(array(
            "Id" => $User[0]->getId(),
            "Name" => $User[0]->getName(),
            "Role" => $User[0]->getRole()->getName()
            )
        );
    } else {
        echo json_encode(array("Message" => "fail returning User"));
    }
}else{
    echo json_encode(array("Message" => "click button"));
}