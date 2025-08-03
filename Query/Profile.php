<?php
namespace Account\Query;
use OpenApi\Annotations as OA;
/**
 * @OA\Post(
 *      path="/profile",
 *      summary="This endpoint retrieves users profile on Newdich Technology",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              required={"identity"},
 *              @OA\Property(property="identity", type="string", example="9873y3u8282939282$0383b$2y=")
 *          )
 *      ),
 *      @OA\Response(
 *          response = 200,
 *          description ="array"
 *      )
 * )
 */
use Account\Config\Constant;

class Profile{
    private $identity;
    
    function __construct($identity){
        $this->identity = $identity;
    }

    public function userProfile(){
        global $CONNUSER, $USER_TABLE, $ACTIVE, $PENDING, $SUSPENDED; //variables needed
        //call columns needed
        global $TID, $TEMAL, $TFULLNAME, $TCOUNTRY, $TCOUNTRYCODE, $TPHONE, $TWHATSAPP, $TPASS, $TPIX;
        global $TDATEREG, $TPLINK, $TADDR, $TABOUT, $TFACEBOOK, $TWITTER, $TUSER, $TSTATUS, $TTUTOR, $TOTP;
        global $TVERIFIED, $TLASTSEEN, $TCV, $TOFFICIAL, $TIDENTITY, $TOTPVERIFIED, $TGENDER, $TEMAILVERIFY;
        global $TAMBASSADOR, $TSTUDENT, $TSIWES, $TINTERN, $TGRADUATE, $TSTAFF, $TADMIN;

        try{
            $q = $CONNUSER->prepare("SELECT * FROM $USER_TABLE WHERE $TIDENTITY=:tid");
            $q->bindParam(':tid', $this->identity, PDO::PARAM_STR);
            $q->execute();
            if($q->rowCount() > 0){
                $rq = $q->fetch(PDO::FETCH_ASSOC);
                $userData = array(
                    "email"=>$rq[$TEMAL],
                    "fullName"=>$rq[$TFULLNAME],
                    "country"=>$rq[$TCOUNTRY],
                    "countryCode"=>$rq[$TCOUNTRYCODE],
                    "phoneNumber"=>$rq[$TPHONE],
                    "whatsAppNumber"=>$rq[$TWHATSAPP],
                    "picture"=>$rq[$TPIX],
                    "dateRegistered"=>$rq[$TDATEREG],
                    "profileLink"=>$rq[$TPLINK],
                    "address"=>$rq[$TADDR],
                    "about"=>$rq[$TABOUT],
                    "facebook"=>$rq[$TFACEBOOK],
                    "twitter"=>$rq[$TWITTER],
                    "userName"=>$rq[$TUSER],
                    "status"=>$rq[$TSTATUS],
                    "isTutor"=>$rq[$TTUTOR],
                    "otp"=>$rq[$TOTP],
                    "lastSeen"=>$rq[$TLASTSEEN],
                    "cv"=>$rq[$TCV],
                    "officialPage"=>$rq[$TOFFICIAL],
                    "gender"=>$rq[$TGENDER],
                    "emailVerification"=>$rq[$TEMAILVERIFY],
                    "isAmbassador"=>$rq[$TAMBASSADOR],
                    "isStudent"=>$rq[$TSTUDENT],
                    "isSiwes"=>$rq[$TSIWES],
                    "isIntern"=>$rq[$TINTERN],
                    "isGraduate"=>$rq[$TGRADUATE],
                    "isStaff"=>$rq[$TSTAFF],
                    "isAdmin"=>$rq[$TADMIN]
                );
                http_response_code(200);
                echo json_encode(array("status"=>"success", "response"=>$userData), TRUE);
                exit;
            }
            else{
                http_response_code(400);
                echo json_encode(array("status"=>"failed", "response"=>"user not found"), TRUE);
                exit;
            }
        }
        catch(Exception $e){
            http_response_code(500);
            echo json_encode(array("status"=>"failed", "response"=>$e->getMessage()), TRUE);
        }
    }
}
?>