<?php
include('Database/connect.php');

$nameErr = $emailErr = $msgErr = "";
$name = $email = $message = "";
$valid = true;

if (isset($_POST['submit'])) {

    // Name Validation
    if (empty($_POST['Name'])) {
        $nameErr = "Please enter your name.";
        $valid = false;
    } else {
        $name = trim($_POST['Name']);
    }

    // Email Validation
    if (empty($_POST['Email'])) {
        $emailErr = "Please enter your email.";
        $valid = false;
    } elseif (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Please enter a valid email address.";
        $valid = false;
    } else {
        $email = trim($_POST['Email']);
    }

    // Message Validation
    if (empty($_POST['Message'])) {
        $msgErr = "Please enter your message.";
        $valid = false;
    } else {
        $message = trim($_POST['Message']);
    }

    // If all valid → Insert
    if ($valid) {
        $q = mysqli_query($con, "INSERT INTO feedback VALUES (NULL, '$name', '$email', '$message')");
        if ($q) {
            // Show SweetAlert2 success popup
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent Successfully!',
                        text: 'Thank you for your feedback. We’ll get back to you soon!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location = 'index.php';
                    });
                });
            </script>
            ";
        } else {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: 'Something went wrong while sending your message. Please try again later.',
                    confirmButtonColor: '#d33'
                });
            </script>
            ";
        }
    }
}

include_once("header.php");
?>

<!-- Banner -->
<div class="banner about-bnr w3-agileits">
    <div class="container"></div>
</div>

<!-- Contact Section -->
<div class="contact">
    <div class="container">
        <h2 class="w3ls-title1">Contact <span>Us</span></h2>
        <div class="contact-agileitsinfo">
            <div class="col-md-8 contact-grids">
                <p>As times go by in your life, it becomes more precious. So, make every moment mindful, meaningful, and memorable. The most memorable moments in life are the ones you never planned.</p><br />
                <h5>...BECAUSE WE WILL BE THERE TO PLAN THEM FOR YOU !!</h5>

                <div class="contact-w3form">
                    <h3 class="w3ls-title1">Drop Us a Line</h3>
                    <form action="" method="post">
                        <!-- Message -->
                        <textarea name="Message" placeholder="Message..."><?php echo htmlspecialchars($message); ?></textarea>
                        <?php if ($msgErr) echo "<span style='color:red;'>$msgErr</span><br>"; ?>

                        <!-- Name -->
                        <input type="text" name="Name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>">
                        <?php if ($nameErr) echo "<span style='color:red;'>$nameErr</span><br>"; ?>

                        <!-- Email -->
                        <input type="text" name="Email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                        <?php if ($emailErr) echo "<span style='color:red;'>$emailErr</span><br>"; ?>

                        <input type="submit" name="submit" value="SEND">
                    </form>
                </div>
            </div>

            <div class="col-md-4 contact-grids">
                <div class="cnt-address">
                    <h3 class="w3ls-title1">Address</h3>
                    <h4>Classic Events</h4>
                    <p>Kalwad Road,<br>Rajkot.</p>
                    <h4>Get In Touch</h4>
                    <p>
                        Javgal Patel: +91 90333 36811<br>
                        Mohit Patel: +91 96870 00004<br>
                        E-mail: <a href="mailto:info@classicevents.in">info@classicevents.in</a>
                    </p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<?php
include_once("footer.php");
?>
