<?php
$secretKey = "6LfNPTgrAAAADv04TZf2o6lwY3N7NDmtcVIPlWz";
$responseKey = $_POST['g-recaptcha-response'];
$userIP = $_SERVER['REMOTE_ADDR'];

$url = "https://www.google.com/recaptcha/api/siteverify";
$data = [
    'secret' => $secretKey,
    'response' => $responseKey,
    'remoteip' => $userIP
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$verification = json_decode($result);

if ($verification->success) {
    echo "<h2>✅ Doğrulama Başarılı!</h2>";
} else {
    echo "<h2>❌ reCAPTCHA doğrulaması başarısız.</h2>";
}
?>