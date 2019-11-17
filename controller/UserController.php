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
        $login = filter_input(0,"btnLogin");
        if(isset($login)){
            $uname = filter_input(0,"Uname");
            $pass = filter_input(0,"Pass");
            $usr = new User();
            $usr->setUsername($uname);
            $usr->setPassword($pass);
            $ulogged = $this->userDao->loginUser($usr);
            if($ulogged != false){
                /* @var User $ulogged*/
                $_SESSION["logged_as"] = $ulogged[0]->getRole()->getName();
                $_SESSION["loggedin"] = true;
                header('location:index.php');
            }
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