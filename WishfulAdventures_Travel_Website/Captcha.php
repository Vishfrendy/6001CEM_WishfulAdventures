<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Your reCAPTCHA secret key
    $recaptchaSecretKey = 'YOUR_SECRET_KEY';

    // Verify reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = [
        'secret'   => $recaptchaSecretKey,
        'response' => $recaptchaResponse,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $recaptchaOptions = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($recaptchaData)
        ]
    ];

    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
    $recaptchaData = json_decode($recaptchaResult, true);

    // Check if reCAPTCHA verification is successful
    if ($recaptchaData['success']) {
        $message = "reCAPTCHA verification passed. Form submitted successfully!";
    } else {
        $message = "reCAPTCHA verification failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reCAPTCHA Example</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="captcha">Please verify that you are not a robot:</label>
        <br>
        <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
        <br>
        <button type="submit">Submit</button>
    </form>

</body>
</html>
