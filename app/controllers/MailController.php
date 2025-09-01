<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php'; // corect path-ul

class MailController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function showForm() {
        require __DIR__ . "/../views/doctor/send_mail.php";
    }

    public function sendToAll($data) {
        $subject = $data['subject'];
        $message = $data['message'];

        $stmt = $this->pdo->query("SELECT email, prenume FROM user WHERE rol = 'pacient'");
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $successCount = 0;
        $failCount = 0;

        foreach ($patients as $patient) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'petrica.chitacu04@gmail.com';
                $mail->Password   = 'yscl zqmh anon erfk'; // parola de aplicație Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('petrica.chitacu04@gmail.com', 'Clinica Medicala');
                $mail->addAddress($patient['email'], $patient['prenume']);

                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                //$mail->SMTPDebug = 2; // adaugă asta înainte de $mail->send() ca să vezi exact de ce eșuează

                $mail->send();
                $successCount++;
            } catch (Exception $e) {
                $failCount++;
                // ==opțional: log $mail->ErrorInfo
            }
        }

        $status = "✅ Email trimis la {$successCount} pacienți. ❌ Eșuat la {$failCount}.";
        require __DIR__ . "/../views/doctor/send_mail.php";
    }
}
