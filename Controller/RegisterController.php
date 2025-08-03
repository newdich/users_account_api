<?php
namespace Account\Controller;
use Account\Command\Register;
$email = cleanData($_POST["email"]);
$fullName = cleanData($_POST["fullName"]);
$password = $_POST["password"];
$username = cleanData($_POST["username"]);
$country = cleanData($_POST["country"]);
$phoneNumber = cleanData($_POST["phoneNumber"]);
$whatsAppNumber = cleanData($_POST["whatsAppNumber"]);
$dateRegistered = cleanData($_POST["dateRegistered"]);
$lastSeen = cleanData($_POST["lastSeen"]);
$gender = cleanData($_POST["gender"]);
$address = cleanData($_POST["address"]);
$displayPix = cleanData($_POST["displayPix "]);

function cleanData($data){
    return trim(htmlspecialchars(strtolower($data)));
}

$newUser = new Register($email, $fullName, $password, $username, $country, $phoneNumber, $whatsAppNumber, $dateRegistered, $lastSeen, $gender, $address, '', '', '', '', '', '', '', $displayPix)
?>