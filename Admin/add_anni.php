<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

// Initialize error variables
$imageErr = $nameErr = $priceErr = "";

if (isset($_POST['submit'])) {
    $isValid = true;

    // Get form data
    $nm = trim($_POST['nm']);
    $pr = trim($_POST['price']);
    $fnm = $_FILES["image"]["name"];

    // Validation
    if (empty($fnm)) {
        $imageErr = "Please select an image.";
        $isValid = false;
    }

    if (empty($nm)) {
        $nameErr = "Please enter a name.";
        $isValid = false;
    }

    if (empty($pr)) {
        $priceErr = "Please enter a price.";
        $isValid = false;
    } elseif (!is_numeric($pr)) {
        $priceErr = "Price must be a number.";
        $isValid = false;
    }

    // If all fields are valid
    if ($isValid) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $fnm);

        // session_start();
        if (isset($_SESSION['admin'])) {
            $qry1 = mysqli_query($con, "INSERT INTO anniversary (img, nm, price) VALUES ('$fnm', '$nm', $pr)");

            if ($qry1) {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Anniversary theme added successfully!',
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        window.location = 'anni_disp.php';
                    });
                </script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
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
        <h3 class='w3ls-hdg' align="center">ADD ANNIVERSARY</h3>
        <div class="grid_3 grid_4">
            <div class="tab-content">
                <div class="tab-pane active" id="horizontal-form">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        
                        <!-- Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Select Image</label>
                            <div class="col-sm-8">
                                <input type="file" name="image">
                                <div style="color:red;"><?php echo $imageErr; ?></div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Price</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="price" placeholder="Theme Price" value="<?php if(isset($pr)) echo $pr; ?>">
                                <div style="color:red;"><?php echo $priceErr; ?></div>
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control1" name="nm" placeholder="Theme Name" value="<?php if(isset($nm)) echo $nm; ?>">
                                <div style="color:red;"><?php echo $nameErr; ?></div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="contact-w3form" align="center">
                            <input type="submit" name="submit" class="btn" value="SEND"> 
                            <input type="button" value="DISPLAY" class="btn my" onClick="window.location.href='anni_disp.php'" />
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>
