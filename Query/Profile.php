<?php
include($_SERVER["DOCUMENT_ROOT"]."/config");
class Profile{

    private $email;
    private $password;
    private $id;
    private $table = "USERS_TABLE";
    
    function __construct($emailIn,$passIn,$idIn){
        $this->email = $emailIn;
        $this->password = $passIn;
        $this->id = $idIn;

        $query = _CONNUSER->prepare("SELECT fullName,username,country,phoneNumber,whatsappNumber,status,dateRegistered,lastSeen,gender,address,emailVerification,isAmbassador,isStudent,isSiwes,
        isIntern,isGraduate,isStaff,isAdmin,displayPix FROM $this->table WHERE email=:em AND identity=:id");
        $query->bindParam(':em',$this->email,PDO::PARAM_STR);
        $query->bindParam(':id',$this->id,PDO::PARAM_STR);
        $query->execute();

        $bank = [];

        if($query->rowCount()){
            $retn = $query->fetch(PDO::FETCH_ASSOC);

            $retFullname = $retn['fullName'];
            $retUsername = $retn['username'];
            $retCountry = $retn['country'];
            $retPhonenumber = $retn['phoneNumber'];
            $retWhatsappnumber = $retn['whatsappNumber'];
            $retStatus = $retn['dateRegistered'];
            $retLastseen = $retn['lastSeen'];
            $retGender = $retn['gender'];
            $retAddress = $retn['address'];
            $retEmailverification = $retn['emailVerification'];
            $retIsambassador = $retn['isAmbassador'];
            $retIsstudent = $retn['isStudent'];
            $retIssiwes = $retn['isSiwes'];
            $retIsintern = $retn['isIntern'];
            $retIsgraduate = $retn['isGraduate'];
            $retIsstaff = $retn['isStaff'];
            $retAdmin = $retn['isAdmin'];
            $retDisplaypix = $retn['displayPix'];


            $data = array(
                "fullname" => $retFullname,
                "username" => $retUsername,
                "country" => $retCountry,
                "phonenumber" => $retPhonenumber,
                "whatsappnumber" => $retWhatsappnumber,
                "status" => $retStatus,
                "lastseen" => $retLastseen,
                "gender" => $retGender,
                "address" => $retAddress,
                "emailverification" => $retEmailverification,
                "ambassador" => $retIsambassador,
                "student" => $retIsstudent,
                "siwes" => $retIssiwes,
                "intern" => $retIsintern,
                "graduate" => $retIsgraduate,
                "staff" => $retIsstaff,
                "admin" => $retAdmin,
                "displaypix" => $retDisplaypix
            );

            $bank[] = $data;

            return json_encode(array("status"=>"success","response"=>$bank),TRUE);
        }
        else{
            return json_encode(array("status"=>"failed","response"=>"No data found"),TRUE);
       }
    }

}
$newProfile = new Profile();

?>