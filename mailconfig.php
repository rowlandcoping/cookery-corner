<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '/var/www/html/vendor/autoload.php';

function createMailer(): PHPMailer {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = getenv('MAIL_HOST');
    $mail->Port       = (int) getenv('MAIL_PORT');
    $mail->SMTPAuth   = filter_var(getenv('MAIL_SMTP_AUTH'), FILTER_VALIDATE_BOOLEAN);
    $mail->SMTPSecure = getenv('MAIL_SMTP_SECURE') === 'false' ? false : getenv('MAIL_SMTP_SECURE');
    $mail->setFrom(getenv('MAIL_FROM'), getenv('MAIL_FROM_NAME'));
    $mail->isHTML(true);
    return $mail;
}