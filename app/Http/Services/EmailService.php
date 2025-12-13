<?php

namespace App\Http\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();
        $this->mail->Host       = $_ENV['SMTP_HOST'];
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = $_ENV['SMTP_USER'];
        $this->mail->Password   = $_ENV['SMTP_PASSWORD'];
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = (int) $_ENV['SMTP_PORT'];

        $this->mail->setFrom(
            $_ENV['MAIL_FROM_ADDRESS'] ?? 'no-reply@ivss-lab.ac.id', 
            $_ENV['MAIL_FROM_NAME'] ?? 'IVSS Lab System'
        );
        $this->mail->isHTML(true);
    }

    public function send(string $to, string $subject, string $htmlBody, ?string $textBody = null): bool
    {
        try {
            $this->mail->clearAllRecipients();

            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $htmlBody;
            $this->mail->AltBody = $textBody ?? strip_tags($htmlBody);

            return $this->mail->send();
        } catch (Exception $e) {
            return false;
        }
    }
}