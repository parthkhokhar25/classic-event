<?php
include("../Database/connect.php");
session_start();

$name = $pwd = "";
$error_name = $error_pwd = "";
$login_error = "";

if(isset($_POST['submit']))
{
    $count = 0;
    $name = trim($_POST['nm']);
    $pwd  = trim($_POST['pwd']);

    // Validation for blank fields
    if(empty($name)) {
        $error_name = "Username field cannot be blank.";
        $count++;
    }
    if(empty($pwd)) {
        $error_pwd = "Password field cannot be blank.";
        $count++;
    }

    if($count == 0) {
        $qry = mysqli_query($con, "SELECT * FROM admin WHERE nm='$name' AND pswd='$pwd'");
        if(mysqli_fetch_row($qry))
        {
            $_SESSION['admin'] = $name;
            header('Location:index.php');
            exit;
        }
        else
        {
            // Invalid login → clear both fields and show error
            $login_error = "Invalid username or password.";
            $name = "";
            $pwd = "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Classic Events - Admin Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- CSS Files -->
<link href="../css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="../css/style.css" type="text/css" rel="stylesheet" media="all">
<link href="../css/font-awesome.css" rel="stylesheet"> 

<!-- Fonts -->
<link href="//fonts.googleapis.com/css?family=Abel" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    .login-box {
        max-width: 400px;
        margin: 60px auto;
        background: #f8f8f8;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .login-box input[type="text"],
    .login-box input[type="password"] {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .login-box input[type="submit"] {
        background: #f15a29;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    .login-box input[type="submit"]:hover {
        background: #e04e1f;
    }
</style>
</head>

<body>

<div class="header">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header navbar-left">
                <h1><img src="../images/logo.png"></h1>
            </div>
        </div>
    </nav>		
</div>	

<div class="login-box">
    <h2 align="center">Admin Login</h2>

    <?php if(!empty($login_error)): ?>
        <p style="color:red; text-align:center;"><?php echo $login_error; ?></p>
    <?php endif; ?>

    <form action="" method="post">
        <label>Username</label>
        <input type="text" name="nm" placeholder="Enter Username" value="<?php echo htmlspecialchars($name); ?>">
        <?php if(!empty($error_name)): ?>
            <span class="error-message"><?php echo $error_name; ?></span>
        <?php endif; ?>

        <label>Password</label>
        <input type="password" name="pwd" placeholder="Enter Password">
        <?php if(!empty($error_pwd)): ?>
            <span class="error-message"><?php echo $error_pwd; ?></span>
        <?php endif; ?>

        <div style="text-align:center; margin-top:15px;">
            <input type="submit" name="submit" value="LOGIN">
        </div>
    </form>
</div>

<div class="copy-right w3-agile-text">
    <div class="container">
        <p>© 2025 Classic Events, Rajkot. All rights reserved</p>	
    </div>
</div>

</body>
</html>
