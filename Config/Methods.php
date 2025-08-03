<?php
namespace Account\Config;
class Methods{
    public function generateUsername($email="", $fname=""){
        $fname = trim(htmlspecialchars(strtolower($fname)));
        $fname = str_replace(" ","", $fname);
        $fname = str_replace("_","", $fname);
        $nownow = strtotime(date("Y-m-d H:i:s"));
        $hasho = md5($nownow.$email.$fname);
        $hasharith = crc32($hasho);
        $user = substr($fname, 0, 4);
        $hashoused = substr($hasharith, 0, 4);
        $usernameGenerated = $user.$hashoused;
        return $usernameGenerated;
    }


    public function trimData($data){
        return trim(htmlspecialchars(strtolower($data)));
    }


    public function hashh($data){
        return password_hash($data, PASSWORD_BCRYPT);
    }

    
    public function validateHash($rawData, $hashedData){
        return password_verify($rawData, $hashedData);
    }


    public function otpp($data){
        //return substr(bcadd('0x'.hash('sha256', $data), 0), 0, 4);
        $nownow = strtotime(date("Y-m-d H:i:s"));
        $datah = md5($nownow.$data);
        return substr(crc32($datah), 0, 6);
    }


    public function passwordCheck($data){
        if(strlen($data) < 8){
            return 'failed';
        }
        elseif(strlen($data) >= 8){
            if(preg_match('/^(?=.*[0-9])(?=.*[^a-zA-Z0-9]).+$', $data)){
                return 'success';
            }
            else{
                return 'failed';
            }
        }
    }



    public function sendEmailOTP($otp, $recipient, $name){

    }
}

$newMethod = new Methods();
?>