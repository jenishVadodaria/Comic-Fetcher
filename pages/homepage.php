<?php

/**
 * Home page for the application.
 *
 * Email is accepted from user,
 * Check whether it is valid or not by email verification,
 * if valid then user gets subscribed.
 *
 *
 * PHP version 8.0.7
 * 
 *
 * LICENSE: 
 *
 * @author     jenish vadodariya <jenish.d.v@gmail.com>
 * @version    1.0.0
 * @since      1.0.0 Available since it was introduced.
 */

?>

<!DOCTYPE html>
<html len='en'>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        xkcd: Homepage
    </title>
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../static/css/homepage.css">

</head>

<?php
require_once __DIR__ . '/../DB/db.php';
require_once __DIR__ . '/../mail/verification_mail.php';

if (isset($_POST['submit']) && isset($_POST['email'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $id = md5(time() . $email);


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if email id is already present or not.
        $queryy = "SELECT * FROM userdata where email=? ";
        $stmt = $conn->prepare($queryy);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
?>
            <script>
                alert("This Email id already exists");
            </script>
            <?php

        } else {
            // Prepare Statement and Bound Parameters to prevent against sql injection attacks.
            $resultset = $conn->prepare("INSERT into userdata(email,id) values(?,?)");
            $b_params = $resultset->bind_param('ss', $email, $id);
            $execute = $resultset->execute();

            // redirecting to another page if insertion is successful
            if ($execute === false) {
            ?>
                <script>
                    alert('Oops! Something went wrong.');
                </script>
        <?php
                die();
            }

            if (verification_mail($email, $id) == true) {
                header('Location:./pages/success_page.html');
                exit();
            }
        }
    } else {
        ?>
        <script>
            alert('Please provide a email id')
        </script>
<?php
    }
}

?>

<body>
    <div class="page">
        <div class="container">
            <div class="left">
                <div class="login">XKCD COMICS!</div>
                <div class="text">Enter your email id to recieve xkcd comics every 5 minutes in your mail box.</div>
            </div>
            <div class="right">
                <?php
                // Checking if index exists before using it.
                if (!isset($_SERVER['PHP_SELF'])) {
                    return false;
                }
                ?>
                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="form">
                        <h1>Sign-up</h1>
                        <label for="email">Email</label>
                        <input type="email" name="email" required="">
                        <input type="submit" name="submit" value="send mail">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>