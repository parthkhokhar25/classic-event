<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

$imageErr = $nameErr = $priceErr = "";
$fnm = $nm = $pr = "";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $valid = true;

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
        $priceErr = "Price must be a valid number.";
        $valid = false;
    } else {
        $pr = $_POST['price'];
    }

    // Fetch existing image if new one not uploaded
    $imgQuery = mysqli_query($con, "SELECT img FROM birthday WHERE id=$id");
    $oldImg = mysqli_fetch_assoc($imgQuery)['img'];

    if (empty($_FILES["image"]["name"])) {
        $fnm = $oldImg;
    } else {
        $fnm = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $_FILES["image"]["name"]);
    }

    // If all valid
    if ($valid) {
        $update = mysqli_query($con, "UPDATE birthday SET img='$fnm', nm='$nm', price='$pr' WHERE id='$id'");

        if ($update) {
            echo "
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Updated Successfully!',
                    text: 'Birthday theme updated successfully.',
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
                    title: 'Update Failed!',
                    text: 'Something went wrong while updating. Please try again.',
                    confirmButtonColor: '#d33'
                });
            </script>";
        }
    }
}

$id = $_REQUEST['id'];
$se = mysqli_query($con, "SELECT * FROM birthday WHERE id=$id");
$row = mysqli_fetch_array($se);
?>

<link href="../css/style.css" rel="stylesheet" type="text/css" />

<div class="codes">
<div class="container"> 
<h3 class='w3ls-hdg' align="center">EDIT BIRTHDAY</h3>
<div class="grid_3 grid_4">
    <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                <!-- Image -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Image :</label>
                    <div class="col-sm-8">
                        <input type="file" name="image">
                        <?php if ($imageErr) echo "<span style='color:red;'>$imageErr</span>"; ?>
                    </div>
                    <div align="center">
                        <img src="../images/<?php echo $row['img']; ?>" height="200" width="200"/>
                    </div>
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Price :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1" value="<?php echo $row['price']; ?>" name="price" placeholder="Theme Price">
                        <?php if ($priceErr) echo "<span style='color:red;'>$priceErr</span>"; ?>
                    </div>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label class="col-sm-2 control-label">Enter Name :</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1" value="<?php echo $row['nm']; ?>" name="nm" placeholder="Theme Name">
                        <?php if ($nameErr) echo "<span style='color:red;'>$nameErr</span>"; ?>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="contact-w3form" align="center">
                    <input type="submit" name="submit" class="btn" value="UPDATE">
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
