<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require '../vendor/autoload.php';

#Receive user input
$email_address = $_POST['email_address'];
$feedback = $_POST['feedback'];

#Filter user input
function filter_email_header($form_field) {
return preg_replace('/[nr|!/<>^$%*&]+/','',$form_field);
}

$email_address  = filter_email_header($email_address);

$mail = new PHPMailer(true);

try {


    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '8b440772822335';
    $mail->Password = 'a5c7fbf63c31e1';
    //Recipients
    $mail->setFrom('sammietjuhsayers@hotmail.com', 'Mailer');//Add a recipient
    $mail->addAddress('sammie.sayers@outlook.com' );




    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'uw klacht is in behandeling';
    $mail->Body    = 'uw klacht word zo snel mogelijk in behandeling gebracht: '.$feedback;
    $mail->AltBody = 'uw klacht:'.$feedback;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//if(isset($_POST['email_address']))
//{
//    $data=$_POST['feedback'];
// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('../vendor/data.txt', Logger::WARNING));

// add records to the log
$log->warning('Foo');
$log->error('Bar');{
}

?>