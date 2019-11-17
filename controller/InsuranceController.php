<?php


class InsuranceController
{

    private $insuranceDao;
    /**
     * InsuranceController constructor.
     */
    public function __construct()
    {
        $this->insuranceDao = new InsuranceDao();
    }

    public function index(){
        $addBtnClicked=filter_input(0,"addBtnClicked");
        if(isset($addBtnClicked)){
            $name_class = filter_input(0,"name_class");
            $insurance = new Insurance();
            $insurance->setNameClass($name_class);
            $this->insuranceDao->addInsurance($insurance);
        }

        $deleted=filter_input(1,"id");
        if(isset($deleted)){
            $insurance = new Insurance();
            $insurance->setId($deleted);
            $this->insuranceDao->delInsurance($insurance);
            header("Location:index.php?nav=ins");
        }

        $insurances = $this->insuranceDao->getAllInsurance();
        include_once "view/insurance.php";
    }

    public function update(){

        $id = filter_input(1,'id');
        if(isset($id)){
            $insurance = new Insurance();
            $insurance->setId($id);
            $ins = $this->insuranceDao->getOneInsurance($insurance);
        }

        $updated = filter_input(0,"btnUpdateDown");
        if(isset($updated)){
            $name = filter_input(0,"name_class");
            $insurance = new Insurance();
            $insurance->setNameClass($name);
            $insurance->setId($id);
            $this->insuranceDao->updInsurance($insurance);
            header("Location:index.php?nav=ins");
        }

        include_once "view/insurance_update.php";
    }
}