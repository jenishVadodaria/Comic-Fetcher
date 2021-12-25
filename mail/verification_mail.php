<?php

/**
 *
 * PHP version 8.0.7
 *
 * LICENSE:
 *
 * @author     jenish vadodariya <jenish.d.v@gmail.com>
 * @version    1.0.0
 * @since      1.0.0 Available since it was introduced.
 *
 * Sends email to user that subscribes on homepage.
 * A verification link in sent with email.
 * 
 * @param string $email  email of subscriber.
 * @param string $id     id generated for subscriber.
 *
 */

function verification_mail($email, $id)
{
    require __DIR__ . '/../config.php';
    // send mail
    $to = $email;
    $subject = "Email Verification";
    $sender = Sender;
    if (!isset($_SERVER['SERVER_NAME'])) {
        return false;
    }
    $verification_link = $_SERVER['SERVER_NAME'] . '/mail/valid_user.php?id=' . $id;
    $message = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </head>
    
    <body>
    <div class='container'
    style ='background: #ccffff;
            display: flexbox;
            padding: 40px;
            place-items: center;
            letter-spacing: 1.8px;
            font-family:Helvetica;'>
        <h2 style = 'margin:0;
        padding:0';>Hi,</h2>
        <h2 style = 'margin:0;
        padding:0';>Thank you for subscribing to XKCD-comics. Click the button below to verify your email id.</h2>
        <div
        style='padding-top: 20px;'>
        <a href='$verification_link'>
            <button 
            style='width: 100px;
                   height: 25px;
                   font-weight: bold;
                   background-color:#e6d0ff;
                   border-radius: 15px;'>
            Verify</button>
        </a>
        </div>     
    </div>       
    </body>
    </html>
    ";

    // Carriage return
    $CR = "\r\n";
    $headers = "From: $sender" . $CR;
    $headers .= "MIME-Version: 1.0" . $CR;
    $headers .= "Content-Type: text/html; charset=UTF-8" . $CR;

    if (mail($to, $subject, $message, $headers)) {
        return true;
    } else {
        return false;
    }
}
