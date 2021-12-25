<?php

session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    header('Location: comic_access.php');
    exit();
}

require __DIR__ . '/../config.php';
require __DIR__ . '/comic_api.php';

$servername = SERVER_NAME;
$username = USERNAME;
$password = PASSWORD;
$DB = DBNAME;

$conn = new mysqli($servername, $username, $password, $DB);

// Check if the connection to database is established.
if ($conn->connect_error) {
    die('Something went wrong');
}

$count = $conn->query(' SELECT COUNT(id) from userdata WHERE user_status=1 and subscribed=1');
$user = $conn->query(' SELECT email,id from userdata WHERE user_status=1 and subscribed=1');

$subscribed_user = $count->fetch_array(MYSQLI_ASSOC);

// If id exists then comic mail will be sent to user.
if ($subscribed_user['COUNT(id)'] > 0) {

    while ($row = $user->fetch_row()) {
        comic_mail($row[0], $row[1]);
        break;
    }
    $count->free_result();
} else {
    echo 'No user found';
}

$conn->close();


function comic_mail($email, $id)
{
    $sender = Sender;
    $data = comic_data();
    $img = json_decode($data)->img;
    $num = json_decode($data)->num;
    $comic_title = json_decode($data)->safe_title;
    if (!isset($_SERVER['SERVER_NAME'])) {
        return false;
    }
    $unsubscribe_link = $_SERVER['SERVER_NAME'] . '/mail/unsubscribe_user.php?id=' . $id;
    $to = $email;
    $subject = 'Random XKCD COMICS';
    $message = "
    <!DOCTYPE html>
    <html lang='en'>
    
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
        </style>
    </head>
    
    <body>
        <div class='center'>
            <h1>Comic-Title : $comic_title </h1>
            <h2>Page No. : $num </h2>
            <img src= '$img' /> <br>
            <span style='font-size:small;
            font-style: italic; '>
            if you do not wish to recieve these emails, you can
            </span>
            <a href= '$unsubscribe_link' >
                Unsubscribe here.
            </a>
        </div>
    </body>
    
    </html>
    ";

    $attachment = file_get_contents($img);
    $encoded_content = chunk_split(base64_encode($attachment));
    $name = 'comic.png';
    $boundary = md5('random'); // define boundary with a md5 hashed value
    $New_line = "\r\n";

    //header
    $headers = "MIME-Version: 1.0 " . $New_line; // Defining the MIME version
    $headers .= "From:" . $sender . $New_line; // Sender Email
    $headers .= "Reply-To: " . $sender . $New_line; // Email address to reach back
    $headers .= "Content-Type: multipart/mixed;"; // Defining Content-Type
    $headers .= "boundary = $boundary" . $New_line; //Defining the Boundary

    // comic message
    $body = "--" . $boundary . $New_line;
    $body .= "Content-Type: text/html; charset=ISO-8859-1" . $New_line;
    $body .= "Content-Transfer-Encoding: base64\r\n" . $New_line;
    $body .= chunk_split(base64_encode($message));

    //attachment
    $body .= "--$boundary\r\n";
    $body .= "Content-Type: application/octet-stream; name=" . $name . $New_line;
    $body .= "Content-Disposition: attachment; filename=" . $name . $New_line;
    $body .= "Content-Transfer-Encoding: base64" . $New_line;
    $body .= "Comic-Attachment-Id: " . rand(1000, 99999) . "\r\n" . $New_line;
    $body .= $encoded_content; // Attaching the encoded file with email


    if (mail($to, $subject, $body, $headers)) {;
        return true;
    } else {
        return false;
    }
}

session_destroy();
