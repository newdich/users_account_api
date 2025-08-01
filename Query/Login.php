<?php
include($_SERVER["DOCUMENT_ROOT"]."/config");

class Login{
    private $email;
    private $password;

    public function __construct($emailToUse, $passwordToUse){
        $this->email=$emailToUse;
        $this->password=$passwordToUse;

        try{
            $count=strlen($this->password);
            if($this->email !="" && $this->password !=""){
                if($count >= 8){
                $log = _CONNUSER->prepare("SELECT username,country,phoneNumber,whatsAppNumber,status,dateRegistered,lastSeen,gender,emailVerification,password
                FROM USERS_TABLE WHERE email=:em");
                $log->bindParam(':em',$email,PDO::PARAM_STR);
                //$log->bindParam(':pd',$hashpassword,PDO::PARAM_STR);
                $log->execute();
                $row=$log->rowCount();
                if($row > 0){
                    $row=$log->fetch(PDO::FETCH_ASSOC);
                    $pwd = $row['password'];
                    if(password_verify($password, $pwd)){
                        $user=$row['username'];
                        $coun=$row['country'];
                        $phon=$row['phoneNumber'];
                        $what=$row['whatsAppNumber'];
                        $stat=$row['status'];
                        $datr=$row['dateRegistered'];
                        $last=$row['lastSeen'];
                        $gend=$row['gender'];
                        $veri=$row['emailVerification'];

                        $store=array(
                            "username"=>$user,
                            "country"=>$coun,
                            "phoneNumber"=>$phone,
                            "whatsAppNumber"=>$what,
                            "status"=>$stat,
                            "dateRegistered"=>$datr,
                            "lastSeen"=>$last,
                            "gender"=>$gend,
                            "emailVerification"=>$veri
                        );

                        //send request to update
                        return json_encode(array("status"=>"successful", "response"=>$store), true);
                    }
                    else{
                        return json_encode(array("status"=>"failed", "response"=>"incorrect password"), true);
                    }
                }
                else {
                    return json_encode(array("status"=>"failed", "response"=>"Incorrect Email"), true);
                }
                }
                else{
                    return json_encode(array("status"=>"failed", "response"=>"Password not up to 8 character"), true);
                }
            }
            else{
                return json_encode(array("status"=>"failed", "response"=>"Fill all box"), true);
            }
        }
        catch(Exception $e){
            $output=array("status"=>"failed", "response"=>$e->getMessage());
            return json_encode($output, true);

        }

    }
}

$newLogin= new Login();

?>