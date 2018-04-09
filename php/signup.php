<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if(!$_POST) exit;

// Email address verification, do not edit.
function isEmail($email) {
    return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$email = $_POST['email'];

if (trim($email) == '') {
    echo 'Please enter a valid email address.';
    exit();
}
else if (!isEmail($email)) {
    echo 'You have entered an invalid e-mail address. Please try again.';
    exit();
}

$mail = new PHPMailer(false);
try{

    //Server settings
    $mail->SMTPDebug = 2;                                   // Enable verbose debug output
    $mail->isSMTP();                                        // Set mailer to use SMTP
    $mail->Host = 'smtpout.secureserver.net';                          // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
    $mail->Username = 'your_email';                      // SMTP username
    $mail->Password = 'your_email_password';                     // SMTP password
    $mail->SMTPSecure = '';                                 // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 80;                                       // TCP port to connect to

    //Recipients
    $mail->setFrom('your_from_email_address', 'From Name');
    $mail->addAddress($email, 'Joe User');     // Add a recipient

    $e_body = "You have been contacted by $email";
    $e_reply = "You can contact them via $email";
    $message = wordwrap ($e_body . $e_reply, 70);

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'YOUR EMAIL SUBJECT GOES HERE';
    $mail->Body    = $message;

    $mail->send();

    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h3>Email Sent Successfully.</h3>";
    echo "<p>Thank you <strong>{{ John Doe }}</strong>, your message has been submitted to Renovatio.</p>";
    echo "</div>";
    echo "</fieldset>";
}
catch (Exception $e) {
    echo 'ERROR!';
}
?>
