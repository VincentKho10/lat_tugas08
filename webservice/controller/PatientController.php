<?php


class PatientController
{
    private $insuranceDao;
    private $patientDao;
    /**
     * PatientController constructor.
     */
    public function __construct()
    {
        $this->patientDao = new PatientDao();
        $this->insuranceDao = new InsuranceDao();
    }

    public function index(){


        $btnPatClicked = filter_input(0,"btnPatClicked");
        if(isset($btnPatClicked)){
            $mrn = filter_input(0,"mrn");
            $cidn = filter_input(0,"cidn");
            $nme = filter_input(0,"nme");
            $addr = filter_input(0,"adr");
            $bhp = filter_input(0,"bhp");
            $bhd = filter_input(0,"bhd");
            $phn = filter_input(0,"phn");
            $namafile = $mrn;
            if(($_FILES['pto']['name'] == null) == 1){
                echo "kolom file kosong";
                $pto = "";
            }else{
                $namasementara = $_FILES['pto']['tmp_name'];
                $dirupload = "upload/";
                move_uploaded_file($namasementara,$dirupload.$namafile);
                $pto = $dirupload.$namafile;
            }
            $ins = filter_input(0,"ins");
            $patobj = new Patient();
            $patobj->setMedRecordNumber($mrn);
            $patobj->setCitizenIdNumber($cidn);
            $patobj->setName($nme);
            $patobj->setAddress($addr);
            $patobj->setBirthPlace($bhp);
            $patobj->setBirthDate($bhd);
            $patobj->setPhoneNumber($phn);
            $patobj->setPhoto($pto);
            $patobj->setInsurance($ins);
            $this->patientDao->addPatient($patobj);
        }

        $deleted = filter_input(1,"mrn");
        if(isset($deleted)){
            $patobj = new Patient();
            $patobj->setMedRecordNumber($deleted);
            $pat = $this->patientDao->getOnePatient($patobj);
            unlink($pat->getPhoto());
            $this->patientDao->delPatient($patobj);
            header('Location:index.php?nav=pat');
        }

        $insurances = $this->insuranceDao->getAllInsurance();
        $patients = $this->patientDao->getAllPatient();
        include_once "view/patient.php";
    }

    public function upd(){
        $mrn=filter_input(1,"mrn");
        if(isset($mrn)){
            $patobj = new Patient();
            $patobj->setMedRecordNumber($mrn);
            $mrns = $this->patientDao->getOnePatient($patobj);
        }

        $updated=filter_input(0,"btnPatClicked");
        if(isset($updated)){
            $cidn = filter_input(0,"cidn");
            $nme = filter_input(0,"nme");
            $addr = filter_input(0,"adr");
            $bhp = filter_input(0,"bhp");
            $bhd = filter_input(0,"bhd");
            $phn = filter_input(0,"phn");
            $ins = filter_input(0,"ins");
            $namafile = $mrn;
            if(($_FILES['pto']['name'] == null) == 1){
                echo "kolom file kosong";
                $pto = $mrns->getPhoto();
            }else{
                unlink($mrns->getPhoto());
                $namatemp = $_FILES['pto']['tmp_name'];
                $namadir = "upload/";
                move_uploaded_file($namatemp,$namadir.$namafile);
                $pto = $namadir.$namafile;
            }
            $patobj = new Patient();
            $patobj->setMedRecordNumber($mrn);
            $patobj->setCitizenIdNumber($cidn);
            $patobj->setName($nme);
            $patobj->setAddress($addr);
            $patobj->setBirthPlace($bhp);
            $patobj->setBirthDate($bhd);
            $patobj->setPhoneNumber($phn);
            $patobj->setPhoto($pto);
            $patobj->setInsurance($ins);
            $this->patientDao->updPatient($patobj);
            header("Location:index.php?nav=pat");
        }

        $insurances = $this->insuranceDao->getAllInsurance();
        include_once "view/patient_update.php";
    }
}