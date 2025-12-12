<?php
include_once("Database/connect.php");

$token_error = "";
$password_error = "";
$confirm_error = "";
$success_message = "";
$username = "";
$valid = false;

if(isset($_GET['token']))
{
    $token = $_GET['token'];

    $sql = "SELECT username, expires_at FROM password_resets WHERE token = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);

        if(strtotime($row['expires_at']) > time())
        {
            $valid = true;
            $username = $row['username'];
        }
        else
        {
            $token_error = "Token expired.";
        }
    }
    else
    {
        $token_error = "Invalid token.";
    }
}

if(isset($_POST['submit']) && $valid)
{
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];
    $token = $_POST['token'];

    if($new === "") $password_error = "Enter new password";
    if(strlen($new) < 6) $password_error = "Password must be 6+ characters";

    if($confirm === "") $confirm_error = "Confirm password";
    if($new !== $confirm) $confirm_error = "Passwords do not match";

    if($password_error === "" && $confirm_error === "")
    {
        $update = mysqli_prepare($con, "UPDATE login SET pswd = ? WHERE unm = ?");
        mysqli_stmt_bind_param($update, "ss", $new, $username);
        mysqli_stmt_execute($update);

        mysqli_query($con, "DELETE FROM password_resets WHERE token = '$token'");

        $success_message = "Password updated successfully!";
        $valid = false;
    }
}

include_once("header.php");
?>

<div class="banner about-bnr"></div>

<div class="codes">
    <div class="container">
        <h2 align="center">Reset Password</h2>

        <?php if($token_error) { ?>
            <div class="alert alert-danger"><?php echo $token_error; ?></div>
        <?php } ?>

        <?php if($success_message) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
            <div align="center"><a href="login.php">Login Now</a></div>
        <?php } ?>

        <?php if($valid) { ?>
        <form action="" method="post">

            <input type="hidden" name="token" value="<?php echo $token; ?>">

            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control1">
                <p style="color:red;"><?php echo $password_error; ?></p>
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control1">
                <p style="color:red;"><?php echo $confirm_error; ?></p>
            </div>

            <div class="contact-w3form" align="center">
					<input type="submit" name="submit" value="RESET PASSWORD">
			</div>
            
        </form>
        <?php } ?>

    </div>
</div>

<?php include_once("footer.php"); ?>
