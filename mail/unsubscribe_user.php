<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xkcd: unsubscribe</title>
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
    $resultSet = $conn->query("SELECT subscribed,id from userdata WHERE subscribed= 1 AND id='$id' LIMIT 1");

    if ($resultSet->num_rows == 1) {
        $delete_query = "DELETE FROM userdata WHERE id = '$id' AND subscribed=1 LIMIT 1";
        $check = $conn->query($delete_query);

        if ($check) {
            $text = 'You have been Unsubscibed from the XKCD Comics.';
        } else {
            $text = $conn->error;
        }
    } else {
        $text = 'Link is Invalid or User already has unsubscribed.';
    }
} else {
    die("Something went wrong");
}

?>

?>

<body>
    <div class="center">
        <h1 class="text"><?php echo $text; ?></h1>
    </div>

</body>

</html>