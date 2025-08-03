<?php
namespace Account\Command;
use OpenApi\Annotations as OA;
/**
 * @OA\Post(
 *     path="/update",
 *     summary="This endpoint updates a user's account",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={
 *                 "email", "identity", "fullName", "country", "countryCode", "phoneNumber",
 *                 "whatsAppNumber", "pix", "address", "about", "facebook", "twitter",
 *                 "username", "isTutor", "otp", "lastSeen", "cv", "gender",
 *                 "emailVerification", "isAmbassador", "isStudent", "isSiwes",
 *                 "isIntern", "isGraduate", "isStaff", "isAdmin"
 *             },
 *             @OA\Property(property="email", type="string", example="user@gmail.com"),
 *             @OA\Property(property="identity", type="string", example="ID123456"),
 *             @OA\Property(property="fullName", type="string", example="John Doe"),
 *             @OA\Property(property="country", type="string", example="Nigeria"),
 *             @OA\Property(property="countryCode", type="string", example="+234"),
 *             @OA\Property(property="phoneNumber", type="string", example="08123456789"),
 *             @OA\Property(property="whatsAppNumber", type="string", example="08123456789"),
 *             @OA\Property(property="pix", type="string", example="https://example.com/image.jpg"),
 *             @OA\Property(property="address", type="string", example="123 Example Street"),
 *             @OA\Property(property="about", type="string", example="A brief bio..."),
 *             @OA\Property(property="facebook", type="string", example="https://facebook.com/username"),
 *             @OA\Property(property="twitter", type="string", example="https://twitter.com/username"),
 *             @OA\Property(property="username", type="string", example="johndoe"),
 *             @OA\Property(property="isTutor", type="boolean", example=true),
 *             @OA\Property(property="otp", type="string", example="123456"),
 *             @OA\Property(property="lastSeen", type="string", format="date-time", example="2025-08-01T12:00:00Z"),
 *             @OA\Property(property="cv", type="string", example="https://example.com/cv.pdf"),
 *             @OA\Property(property="gender", type="string", example="Male"),
 *             @OA\Property(property="emailVerification", type="boolean", example=true),
 *             @OA\Property(property="isAmbassador", type="boolean", example=false),
 *             @OA\Property(property="isStudent", type="boolean", example=true),
 *             @OA\Property(property="isSiwes", type="boolean", example=false),
 *             @OA\Property(property="isIntern", type="boolean", example=false),
 *             @OA\Property(property="isGraduate", type="boolean", example=true),
 *             @OA\Property(property="isStaff", type="boolean", example=false),
 *             @OA\Property(property="isAdmin", type="boolean", example=false)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Array of updated user information"
 *     )
 * )
 */

use Account\Config\Constant;
use Account\Config\Methods;
use Account\Query\Profile;

class Update{
    private $email;
    private $identity;
    private $fullname;
    private $country;
    private $countrycode;
    private $phonenumber;
    private $whatsapp;
    //private $password;
    private $pix;
    private $address;
    private $about;
    private $facebook;
    private $twitter;
    private $username;
    //private $status;
    private $isTutor;
    private $otp;
    //private $verified;
    private $lastSeen;
    private $cv;
    private $gender;
    private $emailVerification;
    private $isAmbassador;
    private $isStudent;
    private $isSiwes;
    private $isIntern;
    private $isGraduate;
    private $isStaff;
    private $isAdmin;
       
    function __construct($email="", $identity="", $fullname="", $country="", $countrycode="", $phonenumber="", $whatsapp="", $pix="", $address="", $about="", $facebook="", $twitter="", $username="", $status="", $isTutor="", $otp="", $lastSeen="", $cv="", $gender="", $emailVerification="", $isAmbassador="", $isStudent="", $isSiwes="", $isIntern="", $isGraduate="", $isStaff="", $isAdmin=""){
        $this->email = $newMethod->trimData($email);
        $this->identity = $newMethod->trimData($identity);
        $this->fullname = $newMethod->trimData($fullname);
        $this->country = $newMethod->trimData($country);
        $this->countrycode = $newMethod->trimData($countrycode);
        $this->phonenumber = $newMethod->trimData($phonenumber);
        $this->whatsapp = $newMethod->trimData($whatsapp);
        $this->pix = $pix;
        $this->address = $newMethod->trimData($address);
        $this->about = $newMethod->trimData($about);
        $this->facebook = $newMethod->trimData($facebook);
        $this->twitter = $newMethod->trimData($twitter);
        $this->username = $newMethod->trimData($username);
        $this->gender = $newMethod->trimData($gender);

        $this->status = $newMethod->trimData($status);
        $this->isTutor = $newMethod->trimData($isTutor);
        $this->otp = $newMethod->trimData($otp);
        //$this->verified = $newMethod->trimData($verified);
        $this->lastSeen = $newMethod->trimData($lastSeen);
        $this->cv = $cv;
        $this->emailVerification = $newMethod->trimData($emailVerification);
        $this->isAmbassador = $newMethod->trimData($isAmbassador);
        $this->isStudent = $newMethod->trimData($isStudent);
        $this->isSiwes = $newMethod->trimData($isSiwes);
        $this->isIntern = $newMethod->trimData($isIntern);
        $this->isGraduate = $newMethod->trimData($isGraduate);
        $this->isStaff = $newMethod->trimData($isStaff);
        $this->isAdmin = $newMethod->trimData($isAdmin);
        
    }


    public function updateUser(){
        global $CONNUSER, $USER_TABLE, $ACTIVE, $PENDING, $SUSPENDED; //variables needed
        //call columns needed
        global $TID, $TEMAL, $TFULLNAME, $TCOUNTRY, $TCOUNTRYCODE, $TPHONE, $TWHATSAPP, $TPASS, $TPIX;
        global $TDATEREG, $TPLINK, $TADDR, $TABOUT, $TFACEBOOK, $TWITTER, $TUSER, $TSTATUS, $TTUTOR, $TOTP;
        global $TVERIFIED, $TLASTSEEN, $TCV, $TOFFICIAL, $TIDENTITY, $TOTPVERIFIED, $TGENDER, $TEMAILVERIFY;
        global $TAMBASSADOR, $TSTUDENT, $TSIWES, $TINTERN, $TGRADUATE, $TSTAFF, $TADMIN;

        try{
            //firstly get users details
            $newProfile = new Profile($this->identity);
            $hisProfile = json_decode($newProfile->userProfile(), TRUE);
            if($hisProfile["status"] ==="success"){
                $response = $hisProfile["response"];

                $Demail = $response["email"];
                $DfullName = $response["fullName"];
                $Dcountry = $response["country"];
                $DcountryCode = $response["countryCode"];
                $DphoneNumber = $response["phoneNumber"];
                $DwhatsAppNumber = $response["whatsAppNumber"];
                $Dpicture = $response["picture"];
                $DdateRegistered = $response["dateRegistered"];
                $DprofileLink = $response["profileLink"];
                $Daddress = $response["address"];
                $Dabout = $response["about"];
                $Dfacebook = $response["facebook"];
                $Dtwitter = $response["twitter"];
                $DuserName = $response["userName"];
                $Dstatus = $response["status"];
                $DisTutor = $response["isTutor"];
                $Dotp = $response["otp"];
                $DlastSeen = $response["lastSeen"];
                $Dcv = $response["cv"];
                $DofficialPage = $response["officialPage"];
                $Dgender = $response["gender"];
                $DemailVerification = $response["emailVerification"];
                $DisAmbassador = $response["isAmbassador"];
                $DisStudent = $response["isStudent"];
                $DisSiwes = $response["isSiwes"];
                $DisIntern = $response["isIntern"];
                $DisGraduate = $response["isGraduate"];
                $DisStaff = $response["isStaff"];
                $DisAdmin = $response["isAdmin"];



                $SfullName ='';
                $Scountry ='';
                $ScountryCode ='';
                $SphoneNumber ='';
                $SwhatsAppNumber ='';
                $Spicture ='';
                $SdateRegistered = '';
                $SprofileLink ='';
                $Saddress ='';
                $Sabout ='';
                $Sfacebook = '';
                $Stwitter ='';
                $SuserName ='';
                $Sstatus ='';
                $SisTutor ='';
                $Sotp ='';
                $SlastSeen ='';
                $Scv ='';
                $SofficialPage ='';
                $Sgender ='';
                $SemailVerification='';
                $SisAmbassador = '';
                $SisStudent ='';
                $SisSiwes ='';
                $SisIntern = '';
                $SisGraduate = '';
                $SisStaff ='';
                $SisAdmin = '';

                if(empty($this->fullname)){
                    $SfullName = $DfullName;
                }
                else{
                    $SfullName = $this->fullname;
                }

                if(empty($this->country)){
                    $Scountry = $Dcountry;
                }
                else{
                    $Scountry = $this->country;
                }

                if(empty($this->countryCode)){
                    $ScountryCode = $DcountryCode;
                }
                else{
                    $ScountryCode = $this->countryCode;
                }

                if(empty($this->phonenumber)){
                    $SphoneNumber = $DphoneNumber;
                }
                else{
                    $SphoneNumber = $this->phonenumber;
                }

                if(empty($this->whatsapp)){
                    $SfullName = $DfullName;
                }
                else{
                    $SfullName = $this->whatsapp;
                }


                if(empty($this->pix)){
                    $Spicture = $Dpicture;
                }
                else{
                    $Spicture = $this->pix;
                }

                if(empty($this->address)){
                    $Saddress = $Daddress;
                }
                else{
                    $Saddress = $this->address;
                }

                if(empty($this->about)){
                    $Sabout = $Dabout;
                }
                else{
                    $Sabout = $this->about;
                }

                if(empty($this->facebook)){
                    $Sfacebook = $Dfacebook;
                }
                else{
                    $Sfacebook = $this->facebook;
                }

                if(empty($this->twitter)){
                    $Stwitter = $Dtwitter;
                }
                else{
                    $Stwitter = $this->twitter;
                }

                if(empty($this->username)){
                    $SuserName = $DuserName;
                }
                else{
                    $SuserName = $this->username;
                }

                if(empty($this->gender)){
                    $Sgender = $Dgender;
                }
                else{
                    $Sgender = $this->gender;
                }

                if(empty($this->isTutor)){
                    $SisTutor = $DisTutor;
                }
                else{
                    $SisTutor = $this->isTutor;
                }

                if(empty($this->otp)){
                    $Sotp = $Dotp;
                }
                else{
                    $Sotp = $this->otp;
                }

                if(empty($this->lastSeen)){
                    $SlastSeen = $DlastSeen;
                }
                else{
                    $SlastSeen = $this->lastSeen;
                }

                if(empty($this->cv)){
                    $Scv = $Dcv;
                }
                else{
                    $Scv = $this->cv;
                }

                if(empty($this->emailVerification)){
                    $SemailVerification = $DemailVerification;
                }
                else{
                    $SemailVerification = $this->emailVerification;
                }

                if(empty($this->isAmbassador)){
                    $SisAmbassador = $DisAmbassador;
                }
                else{
                    $SisAmbassador = $this->isAmbassador;
                }

                if(empty($this->isStudent)){
                    $SisStudent = $DisStudent;
                }
                else{
                    $SisStudent = $this->isStudent;
                }

                if(empty($this->isSiwes)){
                    $SisSiwes = $DisSiwes;
                }
                else{
                    $SisSiwes = $this->isSiwes;
                }

                if(empty($this->isIntern)){
                    $SisIntern = $DisIntern;
                }
                else{
                    $SisIntern = $this->isIntern;
                }

                if(empty($this->isGraduate)){
                    $SisGraduate = $DisGraduate;
                }
                else{
                    $SisGraduate = $this->isGraduate;
                }

                if(empty($this->isStaff)){
                    $SisStaff = $DisStaff;
                }
                else{
                    $SisStaff = $this->isStaff;
                }

                if(empty($this->isAdmin)){
                    $SisAdmin = $DisAdmin;
                }
                else{
                    $SisAdmin = $this->isAdmin;
                }



                $qu = $CONNUSER->prepare("UPDATE $USER_TABLE SET 
                    $TFULLNAME=:fn, $TCOUNTRY=:ct, $TCOUNTRYCODE=:cc, $TPHONE=:phone, $TWHATSAPP=:wn, $TPIX=:pix, 
                    $TADDR=:addr, $TABOUT=:abt, $TFACEBOOK=:fb, $TWITTER=:twt, $TUSER=:user, $TGENDER=:gender,
                    $TTUTOR=:tutor, $TOTP=:otp, $TLASTSEEN=:lastseen, $TCV=:cv, $TEMAILVERIFY=:emv, 
                    $TAMBASSADOR=:amb, $TSTUDENT=:stu, $TSIWES=:siwes, $TINTERN=:intern,  
                    $TGRADUATE=:graduate, $TSTAFF=:staff, $TADMIN=:admin WHERE $TEMAL=:em AND $TIDENTITY=:idd
                ");
                $qu->bindParam(':fn', $SfullName, PDO::PARAM_STR);
                $qu->bindParam(':ct', $Scountry, PDO::PARAM_STR);
                $qu->bindParam(':cc', $ScountryCode, PDO::PARAM_STR);
                $qu->bindParam(':phone', $SphoneNumber, PDO::PARAM_STR);
                $qu->bindParam(':wn', $SwhatsAppNumber, PDO::PARAM_STR);
                $qu->bindParam(':pix', $Spicture, PDO::PARAM_STR);
                $qu->bindParam(':addr', $Saddress, PDO::PARAM_STR);
                $qu->bindParam(':abt', $Sabout, PDO::PARAM_STR);
                $qu->bindParam(':fb', $Sfacebook, PDO::PARAM_STR);
                $qu->bindParam(':twt', $Stwitter, PDO::PARAM_STR);
                $qu->bindParam(':user', $SuserName, PDO::PARAM_STR);
                $qu->bindParam(':gender', $Sgender, PDO::PARAM_STR);
                $qu->bindParam(':tutor', $SisTutor, PDO::PARAM_STR);
                $qu->bindParam(':otp', $Sotp, PDO::PARAM_STR);
                $qu->bindParam(':lastseen', $SlastSeen, PDO::PARAM_STR);
                $qu->bindParam(':cv', $Scv, PDO::PARAM_STR);
                $qu->bindParam(':emv', $SemailVerification, PDO::PARAM_STR);
                $qu->bindParam(':amb', $SisAmbassador, PDO::PARAM_STR);
                $qu->bindParam(':stu', $SisStudent, PDO::PARAM_STR);
                $qu->bindParam(':siwes', $SisSiwes, PDO::PARAM_STR);
                $qu->bindParam(':intern', $SisIntern, PDO::PARAM_STR);
                $qu->bindParam(':graduate', $SisGraduate, PDO::PARAM_STR);
                $qu->bindParam(':staff', $SisStaff, PDO::PARAM_STR);
                $qu->bindParam(':admin', $SisAdmin, PDO::PARAM_STR);
                $qu->bindParam(':em', $Demail, PDO::PARAM_STR);
                $qu->bindParam(':idd', $this->identity, PDO::PARAM_STR);
                $qu->execute();
                if($qu){
                    http_response_code(200);
                    echo json_encode(array("status"=>"success", "response"=>"update successful"), TRUE);
                    exit;
                }
                else{
                    http_response_code(500);
                    echo json_encode(array("status"=>"failed", "response"=>"updating failed"), TRUE);
                    exit;
                }
            }
        }
        catch(Exception $e){
            http_response_code(500);
            echo json_encode(array("status"=>"failed", "response"=>$e->getMessage()), TRUE);
        }
    }
}
?>