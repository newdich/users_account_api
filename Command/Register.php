<?php
 include($_SERVER['DOCUMENT_ROOT'].'/Config');
  class Register{
    private $emailTolow;
    private $identity;
    private $fullName;
    private $passwordToCount;
    private $userNameToLow;
    private $country;
    private $phoneNumber;
    private $whatsAppNumber;
    private $status;
    private $dateRegistered;
    private $lastSeen;
    private $gender;
    private $address;
    private $isAmbassador;
    private $isStudent;
    private $isSiwes;
    private $isIntern;
    private $isGraduate;
    private $isStaff;
    private $isAdmin;
    private $displayPix;
    private $Time;
     public function __construct($emailIn, $identityIn, $fullNameIn, $passwordIn, $usernameIn, $countryIn, $phoneNumberIn, $whatsAppNumberIn, $statusIn, $genderIn, $addressIn, $isAmbassadorIn, $isStudentIn, $isSiwesIn, $isInternIn, $isGraduateIn, $isStaffIn, $isAdminIn, $displayPixIn, $timeIn){
            $this->emailTolow=$emailIn;
            $this->identity=$identityIn;
            $this->fullName=$fullNameIn;
            $this->passwordToCount=$passwordIn;
            $this->userNameToLow=$usernameIn;
            $this->country=$countryIn;
            $this->phoneNumber=$phoneNumberIn;
            $this->whatsAppNumber=$whatsAppNumberIn;
            $this->status=$statusIn;
            //$this->dateRegisterd=$dateRegisteredIn;
            //$this->lastSeen=$lastSeenIn;
            $this->gender =$genderIn;
            $this->address =$addressIn;
            $this->isAmbassador =$isAmbassadorIn;
            $this->isStudent =$isStudentIn;
            $this->isSiwes =$isSiwesIn;
            $this->isIntern =$isInternIn;
            $this->isGraduate =$isGraduateIn;
            $this->isStaff =$isStaffIn;
            $this->isAdmin =$isAdminIn;
            $this->displayPix =$displayPixIn;
            $this->Time =$timeIn;
        if($emailIn==''){
            $sendMe=array("Status"=>"Failed", "Response"=>"email require");
            return  json_encode( $sendMe, TRUE);
        }
        elseif($fullNameIn==''){
            $sendNa=array("Status"=>"Failed", "Response"=>"Fullname need to be fill");
            return json_encode($sendNa, TRUE);
        }
        elseif($passwordIn==''){
            $sendPwd=array("Status"=>"Failed", "Response"=>"Password need to be fill");
            return json_encode($sendPwd, TRUE);
        }
        elseif($statusIn==''){
            $sendSta =array("Status"=>"Failed", "Response"=>"Status must be fill");
            return "status field is require";
        }
        elseif($passwordIn<8){
            $sendPwdCount =array("Status" =>"Failed", "Response" =>"Password must be up to 8 characters");
            return json_encode($sendPwdCount, TRUE);
        }
      
        else{
            //checking  email already exist
            $checkEmail=_CONNUSER->Prepera("SELECT * FROM USERS_TABLE WHERE email:em");
            $checkEmail->bindParam(":em", $emailIn, PDO::PARAM_STR);
            //checking username already exit
            $checkUserName=_CONNUSER->Prepare("SELECT * FROM USER_TABLE WHERE username:usna");
            $checkUserName->bindParam(":usna", $usernameIn, PDO::PARAM_STR);
            if($checkEmail->rowCount() > 0){
                 $sendSelEmail=array("Status" =>"Failed", "Response" =>"Email had been used");
                 return json_encode($sendSelEmail, TRUE);
            }
            elseif($checkUserName->rowCount() > 0){
                $sendSelUsername=array("Status" =>"Failed", "Response" =>"Username had been used");
                return json_encode($sendSelUsername, TRUE);
            }
            else{
                $usertosave;
                $countPwd;
                if($usernameIn ==''){
                    $any = md5($emailIn.$timeIn);
                    $subcut = substr($any,0,3);
                    $usertosave = "user".$subcut;
                }
                elseif($usernameIn !=''){
                    $usertosave = $usernameIn;
                }
                $regUser=__CONNUSER->Prepare("INSERT TO USERS_TABLE(email, identity1, fullName, password1, country, phoneNumber, whatsAppNumber, status1, gender, address1, isAmbassador, isStudent, isSiwes, isIntern, isgraduedate, isStaff, isAmin, displayPix)
                VALUE(:mail, :iden, :full, :pass, :usna, :coun, :num, :whatnum, :sta, :gen, :adr, :amba, :stu, :siw, :inte, :gra, :staf, :admi, :dis)");
                $regUser->bindParam(":mail", $emailIn, PDO::PARAM_STR);
                $regUser->bindParam(":iden", $identityIn, PDO::PARAM_STR);
                $regUser->bindParam(":full", $fullNameIn, PDO::PARAM_STR);
                $regUser->bindParam(":pass", $passwordIn, PDO::PARAM_STR);
                $regUser->bindParam(":usna", $usertosave, PDO::PARAM_STR);
                $regUser->bindParam(":coun", $countryIn, PDO::PARAM_STR);
                $regUser->bindParam(":num", $phoneNumberIn, PDO::PARAM_STR);
                $regUser->bindParam(":whatnum",$whatsAppNumberIn, PDO::PARAM_STR);
                $regUser->bindParam(":sta", $statusIn, PDO::PARAM_STR);
                $regUser->bindParam(":gen", $genderIn, PDO::PARAM_STR);
                $regUser->bindParam(":adr", $addressIn, PDO::PARAM_STR);
                $regUser->bindParam(":amba", $isAmbassadorIn, PDO::PARAM_STR);
                $regUser->bindParam(":stu", $statusIn, PDO::PARAM_STR);
                $regUser->bindParam(":siw", $isSiwesIn, PDO::PARAM_STR);
                $regUser->bindParam(":inte", $isInternIn, PDO::PARAM_STR);
                $regUser->bindParam(":gra", $isGraduateIn, PDO::PARAM_STR);
                $regUser->bindParam(":staf", $isStaffIn, PDO::PARAM_STR);
                $regUser->bindParam(":admi", $isAdminIn, PDO::PARAM_STR);
                $regUser->bindParam(":dis", $displayPixIn, PDO::PARAM_STR);
                $regUser->execute();
                if($regUser){
                /*
                    $mail = new PHPMailer(true);
                    $mail ->isSMTP();
                    $mail ->Host="smtp.gmail.com";
                    $mail ->SMTPAuth=true;
                    $mail ->Username='Host gmail';
                    $mail ->Password="genereted password";
                    $mail ->SMTOSecure=PHPMailer::ENCRYPTION_STARTTLS;
                    $mail ->Port=587;
                    $mail ->setFrom('Host gmail', 'host name');
                    $mail ->addAddress('receiver gmail', 'receiver name');
                    $mail ->isHTML(true);
                    $mail ->Subject="OTP";
                   $mail ->Body=("/account/verify/$emailIn=$email.$user") */


                }
            }
        }
     }
  }
        $email =htmlspecialchars(trim($_REQUEST['email']));
        // converting email to lower case  
        $emailTolow =strtolower($email);
        $identity =md5($_REQUEST['email']);
        $fullName =htmlspecialchars(trim($_REQUEST['fullName']));
        $password =sha1($_REQUEST['password']);
        $passwordToCount=strlen($password);
        $userName =htmlspecialchars(trim($_REQUEST['userName']));
        //  username to lowercase
        $userNameToLow =strtolower($userName);
        $country =htmlspecialchars($_REQUEST['country']);
        $phoneNumber =htmlspecialchars(trim($_REQUEST['phoneNumber']));
        $whatsAppNumber =htmlspecialchars(trim($_REQUEST['whatsAppNumber']));
        $status =htmlspecialchars(trim($_REQUEST['status']));
        $Time =strtotime(date('h:i:s'));
        $gender =htmlspecialchars($_REQUEST['gender']);
        $address =htmlspecialchars($_REQUEST['address']);
        $isAmbassador =htmlspecialchars($_REQUEST['isAmbassador']);
        $isStudent =htmlspecialchars($_REQUEST['isStudent']);
        $isSiwes =htmlspecialchars($_REQUEST['isSiwes']);
        $isIntern =htmlspecialchars($_REQUEST['isIntern']);
        $isGraduate =htmlspecialchars($_REQUEST['isGraduate']);
        $isStaff =htmlspecialchars($_REQUEST['isStaff']);
        $isAdmin =htmlspecialchars($_REQUEST['isAdmin']);
        $displayPix =htmlspecialchars($_REQUEST['displayPix']) ;
 ?>