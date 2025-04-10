<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Haetaan lomakkeen tiedot
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Tarkistetaan, että kaikki kentät on täytetty
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Sähköpostin asetukset
        $to = "laura.makila@example.com"; // Korvaa omalla sähköpostiosoitteellasi
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