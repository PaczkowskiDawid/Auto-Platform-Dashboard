<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validare date
    $venituri = htmlspecialchars($_POST['venituri']);
    $telefon = htmlspecialchars($_POST['telefon']);
    $nume = htmlspecialchars($_POST['nume']);
    $localitate = htmlspecialchars($_POST['localitate']);
    $angajat_pensionar = htmlspecialchars($_POST['angajat_pensionar']);
    $venit_lunar = htmlspecialchars($_POST['venit_lunar']);
    $rate_restante = htmlspecialchars($_POST['rate_restante']);
    $masina = htmlspecialchars($_POST['masina']);

    $to = "ssa.automobile.prahova@gmail.com"; // Adresa unde primești emailurile

    $subject = "Aplicatie noua pentru finantare";
    $message = "
    <html>
    <head><title>Aplicatie noua pentru finantare</title></head>
    <body>
       <p><strong>Informatii Venituri:</strong> $venituri</p>
<p><strong>Telefon:</strong> $telefon</p>
<p><strong>Nume:</strong> $nume</p>
<p><strong>Localitate Domiciliu:</strong> $localitate</p>
<p><strong>Sunteti angajat sau pensionar de minim 3 luni?:</strong> $angajat_pensionar</p>
<p><strong>Aveti un venit lunar de peste 2400 RON?:</strong> $venit_lunar</p>
<p><strong>Aveti rate restante sau sunteti in Biroul de Credit?:</strong> $rate_restante</p>
<p><strong>Masina pentru care aplicati:</strong> $masina</p>

    </body>
    </html>";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ssa.automobile.prahova@gmail.com'; // Schimbă cu adresa ta Gmail
        $mail->Password = 'xkgb bcvb pkix eqgn'; // Folosește o parolă de aplicație!
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('ssa.automobile.prahova@gmail.com', 'Aplicatie Finantare');
        $mail->addAddress($to, 'Destinatar');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

        // Mesaj de succes și redirecționare
        echo "<script>
                alert('Aplicația ta a fost trimisă cu succes!');
                window.location.href = 'finantare.php';
              </script>";
        exit();

    } catch (Exception $e) {
        // Mesaj de eroare și redirecționare
        echo "<script>
                alert('Eroare: Nu s-a putut trimite mesajul. Încearcă din nou!');
                window.location.href = 'finantare.php';
              </script>";
        exit();
    }
}

?>
