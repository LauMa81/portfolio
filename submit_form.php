<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan lomakkeen tiedot
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $recaptcha_secret = '6Le-BhgrAAAAACOLw77oHKVDw_sim0QEJbgkznJG'; // Salainen avain
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Tarkistetaan reCAPTCHA
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
    $response_keys = json_decode($response, true);

    if (intval($response_keys["success"]) !== 1) {
        echo "<p>reCAPTCHA-tarkistus epäonnistui. Yritä uudelleen.</p>";
        exit;
    }

    // Tarkistetaan, että kaikki kentät on täytetty
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Sähköpostin asetukset
        $to = "lauramak@lauramakila.fi"; // Korvaa omalla sähköpostiosoitteellasi
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
?>