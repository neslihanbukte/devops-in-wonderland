<?php

$smtp_host = 'mailpit';
$smtp_port = 1025;

$from = 'test@example.com';
$to = 'alici@example.com';
$subject = 'Mailpit Test Maili';
$message = 'Bu bir test mailidir.';

$smtp = fsockopen($smtp_host, $smtp_port, $errno, $errstr, 30);

if (!$smtp) {
    echo "Bağlantı hatası: $errstr ($errno)\n";
    exit;
}

fgets($smtp, 515);

fwrite($smtp, "HELO localhost\r\n");
fgets($smtp, 515);

fwrite($smtp, "MAIL FROM:<$from>\r\n");
fgets($smtp, 515);

fwrite($smtp, "RCPT TO:<$to>\r\n");
fgets($smtp, 515);

fwrite($smtp, "DATA\r\n");
fgets($smtp, 515);

$headers = "From: $from\r\nTo: $to\r\nSubject: $subject\r\nContent-Type: text/plain; charset=UTF-8\r\n\r\n";
fwrite($smtp, $headers . $message . "\r\n.\r\n");
fgets($smtp, 515);

fwrite($smtp, "QUIT\r\n");
fgets($smtp, 515);

fclose($smtp);
echo "Mail gönderildi!\n";
