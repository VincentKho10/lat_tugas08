<?php


class UserController
{
    private $userDao;
    private $roleDao;

    public function __construct()
    {
        $this->userDao = new UserDao();

        $this->roleDao = new RoleDao();
    }

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
            var_dump($updated);
            $id = filter_input(0,"id");
            $pass = filter_input(0,"pass");
            $confir = filter_input(0,"confpass");
            $user = new User();
            $user->setId($id);
            if($pass == $confir){
                $user->setPassword($confir);
            }else{
                var_dump("password dan verifikasi tidak sama");
            }
            $this->userDao->updUser($user);
            header("Location:index.php?nav=usr");
        }

        $users = $this->userDao->getAllUser();
        $role = $this->roleDao->getAllRole();
        include_once "view/user.php";
    }

    public function login(){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "localhost\pw2-assignment08-20191-VincentKho10\webservice\service\user\Login.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"btnLogin\"\r\n\r\ntrue\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Pass\"\r\n\r\n12345\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Uname\"\r\n\r\nadmin\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Content-Length: 384",
                "Content-Type: application/json",
                "Cookie: PHPSESSID=dkii9gk77iu2m1ee6vptcq3jog",
                "Host: localhost",
                "Postman-Token: d9344d88-3854-4d06-8cbe-8fd82e207b2b,7bfc0e5b-25de-42a0-98bf-2d4145d8279a",
                "User-Agent: PostmanRuntime/7.19.0",
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
            $_SESSION["logged_as"] = $response->getRole()->getName();
            $_SESSION["loggedin"] = true;
            header('location:index.php');
        }
        include_once "view/login.php";
    }

    public function upd(){

        $id=filter_input(1,"id");
        if(isset($id)){
            $user = new User();
            $user->setId($id);
            $users = $this->userDao->getOneUser($user);
            var_dump($users);
        }

        $updated=filter_input(0,"btnUpd");
        if(isset($updated)){
            $id = filter_input(1,"id");
            $pass = filter_input(0,"pass");
            $confir = filter_input(0,"confpass");
            $user = new User();
            $user->setId($id);
            if($pass == $confir){
                $user->setPassword($confir);
            }else{
                var_dump("password dan verifikasi tidak sama");
            }
            $this->userDao->updUser($user);
            header("Location:index.php?nav=usr");
        }

        $users = $this->userDao->getAllUser();
        include_once "view/user_update.php";
    }
}