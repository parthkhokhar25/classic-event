<?php
include_once("Database/connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$username_error = "";
$success_message = "";
$error_message = "";
$username = "";

if(isset($_POST['submit']))
{
    $username = trim($_POST['username']);

    if($username === "")
    {
        $username_error = "Username is required";
    }

    if($username_error === "")
    {
        // Check if user exists and get email from registration table
        $sql = "SELECT unm, email FROM registration WHERE unm = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) > 0)
        {
            $user = mysqli_fetch_assoc($result);
            $email = $user['email'];

            // Generate secure token
            $token = bin2hex(random_bytes(32));
            $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

            // Insert token in password_resets table
            $insert_sql = "INSERT INTO password_resets (username, token, expires_at) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($con, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "sss", $username, $token, $expiry);
            mysqli_stmt_execute($insert_stmt);

            require 'vendor/autoload.php';
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "parthkhokhar61@gmail.com";
                $mail->Password = "cvog lmyb gcga bjsc";
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom("parthkhokhar61@gmail.com", "Classic Events");
                $mail->addAddress($email, $username);

                $mail->isHTML(true);
                $mail->Subject = "Password Reset Request";

                $reset_link = "http://localhost:8080/Event-Management-System/reset_password.php?token=" . $token;

                $mail->Body = "
                    <h2>Password Reset Request</h2>
                    <p>Hello <strong>$username</strong>,</p>
                    <p>Click the link below to reset your password:</p>
                    <p><a href='$reset_link'>Reset Password</a></p>
                    <p>This link expires in 5 minutes.</p>
                ";

                $mail->send();

                $success_message = "A password reset link has been sent to your email.";
                $username = "";

            } catch (Exception $e) {
                $error_message = "Email sending failed: " . $mail->ErrorInfo;
            }

        }
        else
        {
            $error_message = "No account found with this username.";
        }

        mysqli_stmt_close($stmt);
    }
}

include_once("header.php");
?>

<div class="banner about-bnr"></div>

<div class="codes">
    <div class="container"> 
        <h2 class="w3ls-hdg" align="center">Forgot Password</h2>

        <?php if($success_message) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } ?>

        <?php if($error_message) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <form action="" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control1" value="<?php echo htmlspecialchars($username); ?>">
                    <p style="color:red;"><?php echo $username_error; ?></p>
                </div>
            </div>

		<div class="contact-w3form" align="center">
			<input type="submit" name="submit" value="SEND RESET LINK">
		</div>

        <div align="center"><a href="login.php">← Back to Login</a></div>
    </div>
</div>

<?php include_once("footer.php"); ?>
