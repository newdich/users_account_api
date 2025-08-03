<?php
namespace Account\Config;

try{
    $ileos ="localhost"; //server
    $ileone ="root"; //user
    $ilekokoro ="mysql"; //pass
    $iledb ="user"; //db
    
    $CONNUSER = new PDO("mysql:host=$ileos; dbname=$iledb", $ileone, $ilekokoro);
    $CONNUSER->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
    return $e->getMessage();
}

$PAGE_PER_ROW = 50;
$ACTIVE ='active';
$SUSPENDED ='suspended';
$PENDING ='pending';
$YES ='yes';
$NO ='no';

//DATABASE & SERVER CONNECTIONS
$CONNUSER = $CONNUSER;

//TABLE USERS
$USER_TABLE ='';

//TABLE ADMIN
$ADMIN_TABLE ='';


//TABLE USERS COLUMNS
$TID ='newdich_id';
$TEMAL ='email';
$TFULLNAME ='fullname';
$TCOUNTRY ='country';
$TCOUNTRYCODE ='countrycode';
$TPHONE ='phonenumber';
$TWHATSAPP ='whatsapp';
$TPASS ='noku';
$TPIX ='pix';
$TDATEREG ='date_created';
$TPLINK ='profile_link';
$TADDR ='address';
$TABOUT ='about';
$TFACEBOOK ='facebook';
$TWITTER ='twitter';
$TUSER ='username';
$TSTATUS ='status';
$TTUTOR ='is_tutor';
$TOTP ='otp';
$TVERIFIED ='verified';
$TLASTSEEN ='last_login';
$TCV ='cv';
$TOFFICIAL ='official_page';
$TIDENTITY ='hashed_identity';
$TOTPVERIFIED ='verified_otp';
$TGENDER ='gender';
$TEMAILVERIFY ='emailVerification';
$TAMBASSADOR ='isAmbassador';
$TSTUDENT ='isStudent';
$TSIWES ='isSiwes';
$TINTERN ='isIntern';
$TGRADUATE ='isGraduate';
$TSTAFF ='isStaff';
$TADMIN ='isAdmin';
?>