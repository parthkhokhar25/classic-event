<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

$id = $_REQUEST['id'];
$error_image = $error_price = $error_name = "";
$success_message = "";

if(isset($_POST['submit'])) {
    $fnm = $_FILES["image"]["name"];
    $nm = trim($_POST['nm']);
    $pr = trim($_POST['price']);
    $count = 0;

    // Validation for blank fields
    if(empty($nm)) {
        $error_name = "Name field cannot be blank.";
        $count++;
    }
    if(empty($pr)) {
        $error_price = "Price field cannot be blank.";
        $count++;
    } elseif(!is_numeric($pr)) {
        $error_price = "Price must be a valid number.";
        $count++;
    }

    // Fetch current image if not uploading new one
    $se = mysqli_query($con, "SELECT img FROM wedding WHERE id=$id");
    $row_img = mysqli_fetch_assoc($se);
    $current_img = $row_img['img'];

    if(empty($fnm)) {
        $fnm = $current_img;
    } else {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $fnm);
    }

    // If validation passes
    if($count == 0) {
        $update = mysqli_query($con, "UPDATE wedding SET img='$fnm', nm='$nm', price='$pr' WHERE id='$id'");
        if($update) {
            $success_message = "Wedding details updated successfully!";
        } else {
            echo "<script>alert('Error: Could not update record.');</script>";
        }
    }
}

// Fetch record to show in form
$se = mysqli_query($con, "SELECT * FROM wedding WHERE id=$id");
$row = mysqli_fetch_array($se);
?>

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
</style>

<div class="codes">
    <div class="container"> 
        <h3 class='w3ls-hdg' align="center">EDIT WEDDING</h3>
        <div class="grid_3 grid_4">
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Image :</label>
                            <div class="col-sm-8">
                                <input type="file" name="image" class="form-control1">
                            </div>
                            <div align="center">
                                <img src="../images/<?php echo htmlspecialchars($row['img']); ?>" height="200" width="200" style="margin-top:10px; border-radius:10px;"/>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Price :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" value="<?php echo htmlspecialchars($row['price']); ?>" name="price" placeholder="Theme Price">
                                <?php if(!empty($error_price)): ?>
                                    <span class="error-message"><?php echo $error_price; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Name :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" value="<?php echo htmlspecialchars($row['nm']); ?>" name="nm" placeholder="Theme Name">
                                <?php if(!empty($error_name)): ?>
                                    <span class="error-message"><?php echo $error_name; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="contact-w3form" align="center">
                            <input type="submit" name="submit" class="btn" value="UPDATE"> 
                            <input type="button" value="DISPLAY" class="btn my" onClick="javascript:location.href='wed_disp.php'" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($success_message)): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Updated!',
    text: '<?php echo $success_message; ?>',
    confirmButtonColor: '#f15a29',
    confirmButtonText: 'OK'
}).then((result) => {
    if (result.isConfirmed) {
        window.location = 'wed_disp.php';
    }
});
</script>
<?php endif; ?>

<?php include_once("footer.php"); ?>
