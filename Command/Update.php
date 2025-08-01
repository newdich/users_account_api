<?php
 include($_SERVER['DOCUMENT_ROOT'].'');
   class Update{
       private $fname;
       private $password;
       private $username;
       private $country;
       private $phonenumber;
       private $whatAppumber;
       private $status;
       private $dateReg;
       private $lastseen;
       private $gender;
       private $address;
       private $emailvery;
       private $isAmbassador;
       private $isStudent;
       private $isSiwes;
       private $isIntern;
       private $isGraduate;
       private $isStaff;
       private $isAdim;
       private $displayPix;
       private $otp;
       private $email;
       
       public function __construct($fname1, $password2, $username3, $country4, $phonenumber5, $whatAppumber6, $status7, $dateReg8, $lastseen9, $gender10, $address11, $emailvery12, $isAmbassador13, $isStudent14, $isSiwes15, $isIntern16, $isGraduate17, $isStaff18, $isAdim19, $displayPix21, $otp22, $email23){
        $this->fulname=$fname1;
        $this->password=$password2;
        $this->username=$username3;
        $this->country=$country4;
        $this->phoneNumber=$phonenumber5;
        $this->whatAppNumber=$whatAppumber6;
        $this->status=$status7;
        $this->datereg=$dateReg8;
        $this->lastseen=$lastseen9;
        $this->gender=$gender10;
        $this->address=$address11;
        $this->emailverification=$emailvery12;
        $this->isAmbassador=$isAmbassador13;
        $this->isStudent=$isStudent14;
        $this->isSiwes=$isSiwes15;
        $this->isIntern=$isIntern16;
        $this->isGraduate=$isGraduate17;
        $this->isStaff=$isStaff18;
        $this->isAdim=$isAdim19;
        $this->displayPix=$displayPix21;
        $this->otp=$otp22;
        $this->email=$email23;
        global $connector;
        try{
            if($this->fulname ==="" || $this->password ==="" || $this->username ==="" || $this->country ==="" || $this->phoneNumber ==="" ||  $this->whatAppNumber ==="" || $this->status ==="" || $this->datereg ==="" || $this->lastseen ==="" || $this->gender ==="" || $this->address ==="" || $this->emailverification ==="" || $this->isAmbassador ==="" || $this->isStudent ==="" || $this->isSiwes ==="" || $this->isIntern ==="" || $this->isGraduate ==="" || $this->isStaff ==="" || $this->isAdim ==="" || $this->displayPix ==="" || $this->otp=$otp22 ==="" || $this->email ===""){
                 $rise1 =array("status"=>"failed","response"=>"all field");
                 return json_encode($rise1,TRUE);
            }
            elseif(nm){

            }
            $up = $connector->prepare("SELECT * FROM user WHERE email=:em");
            $up->bindParam(':em',$this->email,PDO::PARAM_STR);
            $up->execute();
            if($up->rowCount() > 0){
                $up1 =array("status"=>"failed","response"=>"email not found and update can not be successful");
                return json_encode($up1,TRUE);
            }
            else{
                $down = $connector->prepare("UPDATE user SET username=:us AND password1=:psd WHERE email=:em");
                $down->bindParam(':us',$this->username,PDO::PARAM_STR);
                $down->bindParam(':psd',$this->password,PDO::PARAM_STR);
                $down->bindParam(':em',$this->email,PDO::PARAM_STR);
                $down->execute();
                if($down){
                    $dowm1 = array("status"=>"success","respose"=>"update successfully");
                }
            }
        }
        catch(Exception $q){
            return "Error".$q->getMessage();

        }
      }
   }



   $uppdate_fulname = htmlspecialchars(trim($_REQUEST['fulname']))??'';
   $update_password = $_REQUEST['password']??'';
   $updat_username = htmlspecialchars(trim($_REQUEST['username']))??'';
   $updat_country = htmlspecialchars(trim($_REQUEST['country']))??'';
   $updat_phoneNumber = htmlspecialchars(trim($_REQUEST['phoneNumber']))??'';
   $updat_whatAppNumber = htmlspecialchars(trim($_REQUEST['whatAppNumber']))??'';
   $updat_status = htmlspecialchars(trim($_REQUEST['status']))??'';
   $updat_datereg = htmlspecialchars(trim($_REQUEST['datereg']))??'';
   $updat_lastseen = htmlspecialchars(trim($_REQUEST['lastseen']))??'';
   $updat_gender = htmlspecialchars(trim($_REQUEST['gender']))??'';
   $updat_address = htmlspecialchars(trim($_REQUEST['address']))??'';
   $updat_emailverification = htmlspecialchars(trim($_REQUEST['emailverification']))??'';
   $updat_isAmbassador = htmlspecialchars(trim($_REQUEST['isAmbassador']))??'';
   $updat_isStudent = htmlspecialchars(trim($_REQUEST['isStudent']))??'';
   $updat_isSiwes = htmlspecialchars(trim($_REQUEST['isSiwes']))??'';
   $updat_isIntern = htmlspecialchars(trim($_REQUEST['isIntern']))??'';
   $updat_isGraduate = htmlspecialchars(trim($_REQUEST['isGraduate']))??'';
   $updat_isStaff = htmlspecialchars(trim($_REQUEST['isStaff']))??'';
   $updat_isAdim = htmlspecialchars(trim($_REQUEST['isAdim']))??'';
   $updat_displayPix = htmlspecialchars(trim($_REQUEST['displayPix']))??'';
   $updat_otp = htmlspecialchars(trim($_REQUEST['otp']))??'';
   $updat_email = htmlspecialchars(trim($_REQUEST['email']))??'';
   //$updat_username = htmlspecialchars(trim($_REQUEST['']))??'';
?>