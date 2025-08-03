<?php
require_once __DIR__ . '/vendor/autoload.php';
use Account\Command\Register;
use Account\Controller\RegisterController;
if($_SERVER["REQUEST_URI"] ==='/register'){
    $input = json_decode(file_get_contents("php://input"), true);
    $email = $input["email"];
    $fullName = $input["fullName"];
    $password = $input["password"];
    $username = $input["username"];
    $country = $input["country"];
    $phoneNumber = $input["phoneNumber"];
    $whatsAppNumber = $input["whatsAppNumber"];
    $dateRegistered = $input["dateRegistered"];
    $lastSeen = $input["lastSeen"];
    $gender = $input["gender"];
    $address = $input["address"];
    $displayPix = $input["displayPix "];

    $newUser = new Register($email, $fullName, $password, $username, $country, $phoneNumber, $whatsAppNumber, $dateRegistered, $lastSeen, $gender, $address, '', '', '', '', '', '', '', $displayPix);
    $newUser->registration();
    //$n = new Register();
    //echo $n->trimData($email);
}
?>