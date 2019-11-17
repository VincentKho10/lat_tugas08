<?php
include_once "db_function/InsuranceDao.php";
include_once "db_function/PatientDao.php";
include_once "db_function/UserDao.php";
include_once "db_function/RoleDao.php";
include_once "controller/InsuranceController.php";
include_once "controller/UserController.php";
include_once "controller/PatientController.php";
include_once "controller/RoleController.php";
include_once "Entity/Insurance.php";
include_once "Entity/Patient.php";
include_once "Entity/Role.php";
include_once "Entity/User.php";
include_once "Util/DBHelper.php";

session_start();

if(!isset($_SESSION['loggedin'])){
    $_SESSION['loggedin']=false;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="plugins/datatables.min.css">
    <script src="js/my_js.js" type="text/javascript"></script>
</head>
<body>
    <header></header>

    <main>
        <?php
        if(!$_SESSION['loggedin']){
            $usr = new UserController();
            $usr->login();
        }else {
            switch ($_SESSION['logged_as']){
                case"Admin":
                    ?>
                    <nav>
                        <ul>
                            <li><a href="?nav=hm">home</a></li>
                            <li><a href="?nav=ins">insurance</a></li>
                            <li><a href="?nav=pat">patient</a></li>
                            <li><a href="?nav=usr">user</a></li>
                            <li><a href="?nav=lout">logout</a></li>
                        </ul>
                    </nav>
                    <?php
                    break;
                case"Manager":
                    ?>
                    <nav>
                        <ul>
                            <li><a href="?nav=ins">insurance</a></li>
                            <li><a href="?nav=pat">patient</a></li>
                            <li><a href="?nav=lout">logout</a></li>
                        </ul>
                    </nav>
                    <?php
                    break;
                case"Registration Officer":
                    ?>
                    <nav>
                        <ul>
                            <li><a href="?nav=pat">patient</a></li>
                            <li><a href="?nav=lout">logout</a></li>
                        </ul>
                    </nav>
                    <?php
                    break;
            }
            $nav = filter_input(1, "nav");
            switch ($nav) {
                case "hm":
                    include_once "view/home.php";
                    break;
                case "ins":
                    $ins = new InsuranceController();
                    $ins->index();
                    break;
                case "insupd":
                    $ins = new InsuranceController();
                    $ins->update();
                    break;
                case "pat":
                    $pat = new PatientController();
                    $pat->index();
                    break;
                case "patupd":
                    $pat = new PatientController();
                    $pat->upd();
                    break;
                case "rle":
                    $rle = new RoleController();
                    $rle->index();
                    break;
                case "rleupd":
                    $rle = new RoleController();
                    $rle->update();
                    break;
                case "usr":
                    $usr = new UserController();
                    $usr->index();
                    break;
                case "usrupd":
                    $usr = new UserController();
                    $usr->upd();
                    break;
                case "lout":
                    session_unset();
                    session_destroy();
                    header("location:index.php");
                    break;
                default:
                    include_once "view/home.php";
                    break;
            }
        }
        ?>
    </main>
<script rel="stylesheet" type="text/javascript" src="plugins/datatables.min.js"></script>
<script rel="stylesheet" type="text/javascript">
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</body>
</html>