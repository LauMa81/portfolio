<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan lomakkeen tiedot
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Tarkistetaan, että kaikki kentät on täytetty
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Sähköpostin asetukset
        $to = "laura.makila81@gmail.com"; // Korvaa omalla sähköpostiosoitteellasi
        $subject = "Uusi yhteydenotto: $name";
        $body = "Nimi: $name\nSähköposti: $email\n\nViesti:\n$message";
        $headers = "From: $email";

        // Lähetetään sähköposti
        if (mail($to, $subject, $body, $headers)) {
            echo "<p>Viesti lähetetty onnistuneesti! Kiitos, että otit yhteyttä.</p>";
        } else {
            echo "<p>Viestiä ei voitu lähettää. Yritä uudelleen myöhemmin.</p>";
        }
    } else {
        echo "<p>Kaikki kentät ovat pakollisia. Täytä lomake uudelleen.</p>";
    }
} else {
    echo "<p>Virheellinen pyyntö.</p>";
}

$recaptcha_secret = '6LeCixYrAAAAAKTCubt5vLu4IGqRq9geszB9bJNq';
$recaptcha_response = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
$response_keys = json_decode($response, true);

if(intval($response_keys["success"]) !== 1) {
    echo 'reCAPTCHA-tarkistus epäonnistui. Yritä uudelleen.';
    exit;
}

?>