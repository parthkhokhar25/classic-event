<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

$imageErr = $nameErr = $priceErr = "";
$fnm = $nm = $pr = "";

if (isset($_POST['submit'])) {
    $valid = true;

    // Image validation
    if (empty($_FILES["image"]["name"])) {
        $imageErr = "Please select an image.";
        $valid = false;
    } else {
        $fnm = $_FILES["image"]["name"];
    }

    // Name validation
    if (empty($_POST['nm'])) {
        $nameErr = "Please enter theme name.";
        $valid = false;
    } else {
        $nm = trim($_POST['nm']);
    }

    // Price validation
    if (empty($_POST['price'])) {
        $priceErr = "Please enter theme price.";
        $valid = false;
    } elseif (!is_numeric($_POST['price'])) {
        $priceErr = "Price must be a number.";
        $valid = false;
    } else {
        $pr = $_POST['price'];
    }

    // If all fields valid
    if ($valid) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);

        if (isset($_SESSION['admin'])) {
            $qry1 = mysqli_query($con, "INSERT INTO birthday(img, nm, price) VALUES('$fnm', '$nm', $pr)");
            
            if ($qry1) {
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Birthday theme added successfully!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'birthd_disp.php';
                        }
                    });
                </script>";
            } else {
                echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to add birthday theme. Please try again.',
                        confirmButtonColor: '#d33'
                    });
                </script>";
            }
        }
    }
}
?>

<div class="codes">
<div class="container"> 
<h3 class='w3ls-hdg' align="center">ADD BIRTHDAY</h3>
<div class="grid_3 grid_4">
    <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                <!-- Image -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Image</label>
                    <div class="col-sm-8">
                        <input type="file" name="image" class="form-control1">
                        <?php if ($imageErr) echo "<span style='color:red;'>$imageErr</span>"; ?>
                    </div>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Price</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1" name="price" value="<?php echo htmlspecialchars($pr); ?>" placeholder="Theme Price">
                        <?php if ($priceErr) echo "<span style='color:red;'>$priceErr</span>"; ?>
                    </div>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1" name="nm" value="<?php echo htmlspecialchars($nm); ?>" placeholder="Theme Name">
                        <?php if ($nameErr) echo "<span style='color:red;'>$nameErr</span>"; ?>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="contact-w3form" align="center">
                    <input type="submit" name="submit" class="btn" value="SEND"> 
                    <input type="button" value="DISPLAY" class="btn my" onClick="javascript:location.href='birthd_disp.php'"/>
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
