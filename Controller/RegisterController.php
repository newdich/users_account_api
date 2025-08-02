<?php
require_once __DIR__ . '/vendor/autoload.php';
use Account\Command\Register; //to access Register command
$email = cleanData($_POST["email"]);
$fullName = cleanData($_POST["fullName"]);
$password = $_POST["email"];
$username = cleanData($_POST["username"]);
$country = cleanData($_POST["country"]);
$phoneNumber = cleanData($_POST["phoneNumber"]);
$whatsAppNumber = cleanData($_POST["whatsAppNumber"]);
$dateRegistered = cleanData($_POST["dateRegistered"]);
$lastSeen = cleanData($_POST["lastSeen"]);
$gender = cleanData($_POST["gender"]);
$address = cleanData($_POST["address"]);
$emailVerification = cleanData($_POST["emailVerification"]);
$isAmbassador = cleanData($_POST["isAmbassador"]);
$isStudent = cleanData($_POST["isStudent"]);
$isSiwes = cleanData($_POST["isSiwes"]);
$isIntern = cleanData($_POST["isIntern"]);
$isGraduate = cleanData($_POST["isGraduate"]);
$isStaff = cleanData($_POST["isStaff"]);
$isAdmin = cleanData($_POST["isAdmin"]);
$displayPix = cleanData($_POST["displayPix "]);

function cleanData($data){
    return trim(htmlspecialchars(strtolower($data)));
}
?>