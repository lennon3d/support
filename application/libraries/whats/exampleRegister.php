<?php
require_once('whatsprot.class.php');
/**
 * This is an example of how you can use the WhatsAPI to request a code
 * from the WhatsAPP server, register that code and retrieve your password.
 *
 * Once you have your password you will then be able to use it in
 * examplefunctional.php to actually send and receive messages.
 *201270434836
 */

$username = "201223745705";
$token = md5($username);
$nickname = "Marwan Zakariya";
$w = new WhatsProt($username, md5($username), $nickname, false);
var_dump($w->codeRequest());

    /*
$username = "201067676608";
$token = md5($username);
$nickname = "Derp";
$w = new WhatsProt($username, $token, $nickname, true);
$result = $w->codeRegister("111629");
$password = $result->pw;
echo "Password is $password";
/*


$username = "201067676608";
$token = md5($username);
$nickname = "Marwan Zakariya";
$w = new WhatsProt($username, $token, $nickname, true);
$w->codeRequest();

$username = "201067676608";
$token = md5($username);
$nickname = "Marwan Zakariya";
$password = "1DxevIHKavEwsOILk+1+HMEza2o=";// e.g. 
$w = new WhatsProt($username, $token, $nickname, true);
$w->Connect();
$w->LoginWithPassword($password);
$w->sendMessage("201067676608", "new");

 


*/
