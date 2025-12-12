<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

$error_img = $error_price = $error_name = ""; // error messages
$image = $price = $name = ""; // store user inputs

if (isset($_POST['submit'])) {
    $valid = true;

    // Validate Image
    if (empty($_FILES["image"]["name"])) {
        $error_img = "Please upload an image.";
        $valid = false;
    } else {
        $image = $_FILES["image"]["name"];
    }

    // Validate Price
    if (empty($_POST['price'])) {
        $error_price = "Please enter the price.";
        $valid = false;
    } else {
        $price = trim($_POST['price']);
    }

    // Validate Name
    if (empty($_POST['nm'])) {
        $error_name = "Please enter the theme name.";
        $valid = false;
    } else {
        $name = trim($_POST['nm']);
    }

    // If all fields are valid → insert into database
    if ($valid) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
        @session_start();
        if (isset($_SESSION['admin'])) {
            $qry1 = mysqli_query($con, "INSERT INTO wedding(img, nm, price) VALUES ('$image', '$name', $price)");
            if ($qry1) {
                echo "<script>alert('Added successfully');</script>";
                echo '<script type="text/javascript">window.location="wed_disp.php";</script>';
            } else {
                echo "<script>alert('Not added');</script>";
            }
        }
    }
}
?>

<link href="../css/style.css" rel="stylesheet" type="text/css" />

<div class="codes">
    <div class="container"> 
        <h3 class='w3ls-hdg' align="center">ADD WEDDING</h3>
        <div class="grid_3 grid_4">
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <!-- Image Field -->
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Enter Image</label>
                            <div class="col-sm-8">
                                <input type="file" name="image" id="image">
                                <?php if ($error_img): ?>
                                    <div style="color:red; margin-top:5px;"><?php echo $error_img; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Price Field -->
                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Enter Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="price" id="price" placeholder="Theme Price" value="<?php echo htmlspecialchars($price); ?>">
                                <?php if ($error_price): ?>
                                    <div style="color:red; margin-top:5px;"><?php echo $error_price; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <div class="form-group">
                            <label for="nm" class="col-sm-2 control-label">Enter Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="nm" id="nm" placeholder="Theme Name" value="<?php echo htmlspecialchars($name); ?>">
                                <?php if ($error_name): ?>
                                    <div style="color:red; margin-top:5px;"><?php echo $error_name; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="contact-w3form" align="center">
                            <input type="submit" name="submit" class="btn" value="SEND">
                            <input type="button" value="DISPLAY" class="btn my" onClick="javascript:location.href='wed_disp.php'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once("footer.php");
?>
