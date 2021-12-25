<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User verification</title>
    <style>
        html {
            background: linear-gradient(#000000, #434343);
            height: 100%;
        }

        .center {
            display: flex;
            justify-content: center;
            margin-top: 300px;
            border: 2px solid wheat;
            background-color: wheat;
            border-radius: 30px;
            font-family: "Satisfy", cursive;


        }

        @media (max-width: 1023px) {
            .center {
                margin-top: 250px;
            }
        }
    </style>
</head>

<?php
require_once __DIR__ . '/../DB/db.php';
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $resultSet = $conn->query("SELECT user_status,subscribed,id from userdata WHERE user_status= 0 AND id='$id' LIMIT 1");

    if ($resultSet->num_rows == 1) {
        $update_query = "UPDATE userdata SET user_status= 1, subscribed= 1 where id = '$id' LIMIT 1";
        $valid_user = $conn->query($update_query);

        if ($valid_user) {
            echo 'User is verified';
        } else {
            echo $conn->error;
        }
    } else {
        echo 'User already verified or it is invalid';
    }
} else {
    die("Error: Request not Valid");
}
?>

<body>
    <div class="center">
        <h1><?php echo $text; ?></h1>
    </div>
</body>

</html>