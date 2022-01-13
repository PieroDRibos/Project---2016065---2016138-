<?php

require_once 'vendor\autoload.php';
require_once 'config\constants.php';  

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL) //auto to email einai responsible gia na kanei forwarding ta emails 
  ->setPassword(PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token) {
    global $mailer; // kanoume thn metavlhth mailer global gia na borei na thn anagnwrisei to function.
    //stelnoume ena  token me to  link , vazwntas '?token' dipla apo to link kai sundewntas ta me .  '.'
    $body = '<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Verify email</title>
        </head>
        <body>
            <div class="wrapper">
                <p>
                    Thank you for signing up on our website. Please click on the link below to verify your email.
                </p>
                <a href="http://localhost/phpask/index.php?token=' . $token . '">
                    Verify your email address
                </a>
            </div>
        </body>
    </html>';

    // Create a message
    $message = (new Swift_Message('Verify your email address'))
    ->setFrom(EMAIL) //to email apo to opoio erxetai to message 
    ->setTo($userEmail) //to email tou user pou kanei receive to message 
    ->setBody($body, 'text/html') //kanoume set to $body na einai se html form.  
    ;

    // Send the message
    $result = $mailer->send($message);
}

?>


