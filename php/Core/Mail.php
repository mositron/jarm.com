<?php
namespace Jarm\Core;

class Mail
{
  public $subject='';
  public $message='';
  public $to='';
  public $_m=null;
  public function __construct()
  {
    require_once(_PHP.'Vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
    /*
    $this->_m = new PHPMailer(true);
    $this->_m->IsSendmail();
    $this->_m->SMTPDebug = 2;
    #$this->_m->IsSMTP();
    $this->_m->CharSet = 'utf-8';
    #$this->_m->Host       = "mail.jarm.com"; // SMTP server
    #$this->_m->SMTPAuth   = true;                  // enable SMTP authentication
    #$this->_m->SMTPSecure = "ssl";                 // sets the prefix to the servier
    #$this->_m->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    #$this->_m->Port       = 465;                   // set the SMTP port for the GMAIL server
    #$this->_m->Username   = "no-replyjarm.comm";  // GMAIL username
    #$this->_m->Password   = "no-reply@inet";            // GMAIL password
    $this->_m->AddReplyTo('no-repljarm.comom',jarm.comom');
    $this->_m->SetFrom('no-repjarm.comcom'jarm.comcom');
    */

    $this->_m = new \PHPMailer;
    //$this->_m->IsSendmail();
    //$this->_m->SMTPDebug = 2;
    #$this->_m->IsSMTP();
    $this->_m->CharSet = 'utf-8';
    #$this->_m->Host       = "mjarm.com.com"; // SMTP server
    #$this->_m->SMTPAuth   = true;                  // enable SMTP authentication
    #$this->_m->SMTPSecure = "ssl";                 // sets the prefix to the servier
    #$this->_m->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    #$this->_m->Port       = 465;                   // set the SMTP port for the GMAIL server
    #$this->_m->Username   = "no-rjarm.comm.com";  // GMAIL username
    #$this->_m->Password   = "no-reply@inet";            // GMAIL password
    $this->_m->AddReplyTo('no-reply@jarm.com');
    $this->_m->SetFrom('no-reply@jarm.com');
  }
  public function send()
  {
    $this->_m->AddAddress($this->to);
    $this->_m->Subject = $this->subject;
    $this->_m->MsgHTML($this->message);
    $v=$this->_m->Send();
    $this->_m->ClearAddresses();
    $this->_m->ClearAttachments();
    return $v;
  }
}



/*
try {
  $mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "yourusername@gmail.com";  // GMAIL username
  $mail->Password   = "yourpassword";            // GMAIL password
  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->AddAddress('whoto@otherdomain.com', 'John Doe');
  $mail->SetFrom('name@yourdomain.com', 'First Last');
  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML(file_get_contents('contents.html'));
  $mail->AddAttachment('img/phpmailer.gif');      // attachment
  $mail->AddAttachment('img/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
*/
?>
