<?php


class UserController
{

    public function index(){

        $btnAdd = filter_input(0,"btnAdd");
        if(isset($btnAdd)){
            $nme = filter_input(0,"Name");
            $rle = filter_input(0,"role");
            $user = new User();
            $user->setName($nme);
            $user->setRole($rle);
            $this->userDao->addUser($user);
        }

        $deleted = filter_input(1,"id");
        if(isset($deleted)){
            $user = new User();
            $user->setId($deleted);
            $this->userDao->delUser($user);
            header('Location:index.php?nav=usr');
        }

        $updated=filter_input(0,"btnUpd");
        if(isset($updated)){
            $curl = curl_init("http://localhost/pw2-assignment08-20191-VincentKho10/webservice/service/user/Update.php");

            $id = filter_input(1,"id");
            $pass = filter_input(0,"pass");
            $confir = filter_input(0,"confpass");
            if($pass == $confir){
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POST,1);
                curl_setopt($curl, CURLOPT_POSTFIELDS,"btnLogin=true&id=".$id."&Pass=".$pass);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    header("Location:index.php?nav=usr");
                }
            }else{
                var_dump("password dan verifikasi tidak sama");
            }

        }

        $users = $this->userDao->getAllUser();
        $role = $this->roleDao->getAllRole();
        include_once "view/user.php";
    }

    public function login(){
        include_once "view/login.php";

        if(isset($_POST['btnLogin'])){
            $curl = curl_init("http://localhost/pw2-assignment08-20191-VincentKho10/webservice/service/user/Login.php");

            $uname='';
            $pass='';

            if(isset($_POST['Uname'])) $uname=$_POST['Uname'];
            if(isset($_POST['Pass'])) $pass=$_POST['Pass'];

            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POST,1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,"btnLogin=true&Uname=".$uname."&Pass=".$pass);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $_SESSION["logged_as"] = $response->Role;
                $_SESSION["loggedin"] = true;
                header('location:index.php');
            }
        }
    }

    public function upd(){
        include_once "view/user_update.php";

        $id=filter_input(1,"id");
        if(isset($id)){
            $curl = curl_init("http://localhost/pw2-assignment08-20191-VincentKho10/webservice/service/user/getOne.php");
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($curl, CURLOPT_POST,1);
            curl_setopt($curl, CURLOPT_POSTFIELDS,"btnLogin=true&id=".$id);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);
                $users = $response;
                var_dump($users);
            }
        }

        $updated=filter_input(0,"btnUpd");
        if(isset($updated)){
            $curl = curl_init("http://localhost/pw2-assignment08-20191-VincentKho10/webservice/service/user/Update.php");

            $id = filter_input(1,"id");
            $pass = filter_input(0,"pass");
            $confir = filter_input(0,"confpass");
            if($pass == $confir){
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_POST,1);
                curl_setopt($curl, CURLOPT_POSTFIELDS,"btnLogin=true&id=".$id."&Pass=".$pass);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    header("Location:index.php?nav=usr");
                }
            }else{
                var_dump("password dan verifikasi tidak sama");
            }

        }
    }
}