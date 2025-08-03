<?php
namespace Account\Command;
use OpenApi\Annotations as OA;
/**
 * @OA\Post(
 *     path="/register",
 *     summary="This endpoint creates account for user on Newdich Platform",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "fullName", "password", "username", "country", "phoneNumber", "whatsAppNumber", "dateRegistered", "lastSeen", "gender", "address"},
 *             @OA\Property(property="email", type="string", example="newdichuser@gmail.com"),
 *             @OA\Property(property="fullName", type="string", example="newdich technology"),
 *             @OA\Property(property="password", type="string", example="********"),
 *             @OA\Property(property="username", type="string", example="newdich"),
 *             @OA\Property(property="country", type="string", example="Nigeria"),
 *             @OA\Property(property="phoneNumber", type="string", example="+4409372827"),
 *             @OA\Property(property="whatsAppNumber", type="string", example="+44272927829"),
 *             @OA\Property(property="dateRegistered", type="string", example="2025-08-03 12:45:55"),
 *             @OA\Property(property="lastSeen", type="string", example="2025-08-03 12:45:55")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful response"
 *     )
 * )
 */

use Account\Config\Constant;
use Account\Config\Methods;

class Register{
    private $emailTolow;
    private $fullName;
    private $passwordToCount;
    private $userNameToLow;
    private $country;
    private $phoneNumber;
    private $whatsAppNumber;
    private $dateRegistered;
    private $lastSeen;

    function __construct($emailIn="", $fullNameIn="", $passwordIn="", $usernameIn="", $countryIn="", $phoneNumberIn="", $whatsAppNumberIn="", $dateRegisteredIn="", $lastSeenIn=""){
        $this->emailTolow = $newMethod->trimData($emailIn);
        $this->fullName = $newMethod->trimData($fullNameIn);
        $this->passwordToCount = $passwordIn;
        $this->userNameToLow = $newMethod->trimData($usernameIn);
        $this->country = $newMethod->trimData($countryIn);
        $this->phoneNumber = $newMethod->trimData($phoneNumberIn);
        $this->whatsAppNumber = $newMethod->trimData($whatsAppNumberIn);
        $this->dateRegisterd=$dateRegisteredIn;
        $this->lastSeen=$lastSeenIn;
    }
    
    public function registration(){
        global $CONNUSER, $USER_TABLE, $ACTIVE, $PENDING, $SUSPENDED; //variables needed
        global $TEMAL, $TFULLNAME, $TPASS, $TUSER, $TCOUNTRY, $TPHONE, $TWHATSAPP, $TDATEREG, $TLASTSEEN; //columns needed
        global $TIDENTITY, $TSTATUS, $TPLINK, $TOFFICIAL, $TOTP, $TEMAILVERIFY; //columns needed
        
        try{
            if(empty($this->emailTolow) || empty($this->fullName) || empty($this->passwordToCount) || empty($this->country)){
                http_response_code(400);
                echo json_encode(array("status"=>"failed", "response"=>"required data must not be empty"), TRUE);
                $CONNUSER = null;
                exit;
            }
            else{
                //checking  email already exist
                $checkEmail=$CONNUSER->prepare("SELECT $TEMAL FROM $USER_TABLE WHERE $TEMAL=:em");
                $checkEmail->bindParam(":em", $this->emailTolow, PDO::PARAM_STR);
                $checkEmail->execute();
                if($checkEmail->rowCount() > 0){
                    http_response_code(409);
                    echo json_encode(array("status"=>"failed", "response"=>"email already registered"), TRUE);
                    $checkEmail = null;
                    $CONNUSER = null;
                    exit();
                }
                else{
                    //checking username already exit
                    $checkUserName=$CONNUSER->prepare("SELECT $TUSER FROM $USER_TABLE WHERE $TUSER=:usna");
                    $checkUserName->bindParam(":usna", $this->userNameTolow, PDO::PARAM_STR);
                    $checkUserName->execute();
                    if($checkUserName->rowCount() > 0){
                        http_response_code(409);
                        echo json_encode(array("status"=>"failed", "reason"=>"username already registered"), TRUE);
                        $checkEmail = null;
                        $CONNUSER = null;
                        exit;
                    }
                    else{
                        //check phonenumber
                        $checkPhoneNumber = $CONNUSER->prepare("SELECT $TPHONE FROM $USER_TABLE WHERE $TPHONE=:phone");
                        $checkPhoneNumber->bindParam(':phone', $this->phoneNumber, PDO::PARAM_STR);
                        $checkPhoneNumber->execute();
                        if($checkPhoneNumber->rowCount() > 0){
                            http_response_code(409);
                            echo json_encode(array("status"=>"failed", "reason"=>"phoneNumber already exist"), TRUE);
                            $checkPhoneNumber = null;
                            $CONNUSER = null;
                            exit;
                        }
                        else{
                            //check whatsappnumber
                            $checkWhatsappNumber = $CONNUSER->prepare("SELECT $TWHATSAPP FROM $USER_TABLE WHERE $TWHATSAPP=:wn");
                            $checkWhatsappNumber->bindParam(':wn', $this->whatsAppNumber, PDO::PARAM_STR);
                            $checkWhatsappNumber->execute();
                            if($checkWhatsappNumber->rowCount() > 0){
                                http_response_code(409);
                                echo json_encode(array("status"=>"failed", "reason"=>"whatsAppNumber already registered"), TRUE);
                                $checkWhatsappNumber = null;
                                $CONNUSER = null;
                                exit;
                            }
                            else{
                                //check if password is valid
                                if($newMethod->passwordCheck($this->passwordToCount) ==='failed'){
                                    http_response_code(422);
                                    echo json_encode(array("status"=>"failed", "response"=>"password must be at least 8 characters long and must contain number and special characters"), TRUE);
                                    exit;
                                }
                                else{
                                    //now register
                                    $otpToUse = $newMethod->otpp($this->emailTolow.strtotime(date("Y-m-d H:i:s")));
                                    $usernameToSave ='';
                                    if($this->userNameToLow ==='' || $this->userNameToLow =='' || $this->userNameToLow ===null || empty($this->userNameToLow)){
                                        $usernameToSave = $newMethod->generateUsername($this->emailTolow, $this->fullName);
                                    }
                                    else{
                                        $usernameToSave = $this->userNameToLow;
                                    }
                                    
                                    $reg = $CONNUSER->prepare("INSERT INTO $USER_TABLE(
                                        $TEMAL, $TIDENTITY, $TFULLNAME, $TPASS, $TUSER, $TCOUNTRY, $TPHONE, $TWHATSAPP,
                                        $TSTATUS, $TDATEREG, $TLASTSEEN, $TEMAILVERIFY, $TOTP, $TOFFICIAL, $TPLINK
                                    ) VALUES(
                                        :em, :id, :fn, :pd, :un, :ct, :phone, :wn, :st, :dr, :ls, :emv, :otp, :official, :link
                                    )");
                                    $reg->bindParam(':em', $this->emailTolow, PDO::PARAM_STR);
                                    $reg->bindParam(':id', $newMethod->hashh($this->emailTolow), PDO::PARAM_STR);
                                    $reg->bindParam(':fn', $this->fullName, PDO::PARAM_STR);
                                    $reg->bindParam(':pd', $newMethod->hashh($this->passwordToCount), PDO::PARAM_STR);
                                    $reg->bindParam(':un', $usernameToSave, PDO::PARAM_STR);
                                    $reg->bindParam(':ct', $this->country, PDO::PARAM_STR);
                                    $reg->bindParam(':phone', $this->phoneNumber, PDO::PARAM_STR);
                                    $reg->bindParam(':wn', $this->whatsAppNumber, PDO::PARAM_STR);
                                    $reg->bindParam(':st', $PENDING, PDO::PARAM_STR);
                                    $reg->bindParam(':dr', $this->dateRegistered, PDO::PARAM_STR);
                                    $reg->bindParam(':ls', $this->lastSeen, PDO::PARAM_STR);
                                    $reg->bindParam(':emv', $PENDING, PDO::PARAM_STR);
                                    $reg->bindParam(':otp', $otpToUse, PDO::PARAM_STR);
                                    $reg->bindParam('official', $PENDING, PDO::PARAM_STR);
                                    $reg->bindParam(':link', $PENDING, PDO::PARAM_STR);
                                    $reg->execute();
                                    if($reg){
                                        //send email verification otp
                                        $newMethod->sendEmailOTP($otpToUse, $this->emailTolow, $this->fullName);
                                        http_response_code(200);
                                        echo json_encode(array("status"=>"success", "response"=>"Registration successful"), TRUE);
                                        $reg = null;
                                        $CONNUSER = null;
                                        exit;
                                    }
                                    else{
                                        http_response_code(401);
                                        echo json_encode(array("status"=>"failed", "response"=>"failed to register"), TRUE);
                                        $reg = null;
                                        $CONNUSER = null;
                                        exit;
                                    }
                                }
                            }
                        }
                    }
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