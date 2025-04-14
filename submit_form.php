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
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h2 style='color: red;'>reCAPTCHA-tarkistus epäonnistui. Yritä uudelleen.</h2>
                <a href='Ota yhteytta.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e85d04; color: white; text-decoration: none; border-radius: 5px;'>Palaa takaisin</a>
              </div>";
        exit;
    }

    // Tarkistetaan, että kaikki kentät on täytetty
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Sähköpostin asetukset
        $to = "laura.makila@lauramakila.fi"; // Korvaa omalla sähköpostiosoitteellasi
        $subject = "Uusi yhteydenotto: $name";
        $body = "Nimi: $name\nSähköposti: $email\n\nViesti:\n$message";
        $headers = "From: $email";

        // Lähetetään sähköposti
        if (mail($to, $subject, $body, $headers)) {
            echo "<div style='text-align: center; margin-top: 50px;'>
                    <h2 style='color: green;'>Viesti lähetetty onnistuneesti! Kiitos, että otit yhteyttä.</h2>
                    <a href='Ota yhteytta.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e85d04; color: white; text-decoration: none; border-radius: 5px;'>Palaa takaisin</a>
                  </div>";
        } else {
            echo "<div style='text-align: center; margin-top: 50px;'>
                    <h2 style='color: red;'>Viestiä ei voitu lähettää. Yritä uudelleen myöhemmin.</h2>
                    <a href='Ota yhteytta.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e85d04; color: white; text-decoration: none; border-radius: 5px;'>Palaa takaisin</a>
                  </div>";
        }
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h2 style='color: red;'>Kaikki kentät ovat pakollisia. Täytä lomake uudelleen.</h2>
                <a href='Ota yhteytta.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e85d04; color: white; text-decoration: none; border-radius: 5px;'>Palaa takaisin</a>
              </div>";
    }
} else {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h2 style='color: red;'>Virheellinen pyyntö.</h2>
            <a href='Ota yhteytta.html' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #e85d04; color: white; text-decoration: none; border-radius: 5px;'>Palaa takaisin</a>
          </div>";
}




?>