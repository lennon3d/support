<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: Hacker
 * Date: 10/30/12
 * Time: 2:45 PM
 * To change this template use File | Settings | File Templates.
 */
require_once BASEPATH ."libs/phpmailer/class.phpmailer.php";

class send_mail extends  PHPMailer
{
    public  function __construct(){
        parent::__construct();
    }

    public function  sendemail($msg = "", $subject = "", $emailto = "", $namefrom = "", $emailfrom =
    "", $isdebug = false)
    {
        $msg = stripcslashes($msg);
        $subject = stripcslashes($subject);
        @header('Content-type: text/html;charset=UTF-8;');
        // ADD from email
 
 



        $this->SetFrom("sadaf@4jawaly.com", "صدف للانتاج");
        $this->AddAddress("hassan@sadaf.tv", "حسن عسيري ");
        // Add body and subject
        $this->Body = trim($msg);
        $this->Subject = trim($subject);
         $this->AddCC("aldini@sadaf.tv", "عمر الديني");
         $this->AddCC("riyad@sadaf.tv", "رياض الاحمد ");
         $this->AddCC("a.alsharif@sadaf.tv", "احمد الشريف ");
         $this->AddCC("firas@sadaf.tv", "فراس شرباتي ");
         $this->AddCC("ali.ahmed@sadaf.tv", "علي ");

        $this->CharSet ="UTF-8";
        // $mail->Encoding = "8bit";
        $sendas = "HTML";
        switch ($sendas) {
            case "HTML":
                $this->IsHTML(true);
                break;

            case "Plain":
                $this->IsHTML(false);
                break;
            default:
                $this->IsHTML(false);
        }
        $sendopt = "mail"  ;
        switch ($sendopt) {
            case "smtp":
                $this->Host = "";
                $this->Port = "";
                $this->Helo = "";
                $this->Timeout = "";
                $this->IsSMTP();
                break;

            case "mail":
                $this->IsMail();
                break;

            case "sendmail":
                $this->IsSendmail();
                break;

            case "Qmail":
                $this->IsQmail();
                break;
            case "smtpau":

                $this->SMTPSecure = "";
                
                $this->Host = "smtp.gmail.com";
                $this->Port = "25";
                $this->Helo = "localhost";
                $this->Timeout = "10";
                $this->IsSMTP();
                $this->SMTPAuth   = true;
                $this->Username   = "sadaf@4jawaly.com";  // GMAIL username
                $this->Password   = "sadafsadaf";            // GMAIL password  */
                break;
            default:
                $this->IsMail();
        }
        $this->MailerDebug = $isdebug;
        $this->SMTPDebug = $isdebug;
        return $this->Send();
    }
}
