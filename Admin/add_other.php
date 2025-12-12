<?php
include_once("header.php");
include('../Database/connect.php');
include('session.php');

$msg_img = $msg_price = $msg_name = ""; // Error messages

if (isset($_POST['submit'])) {
	$fnm = $_FILES["image"]["name"];
	$nm = trim($_POST['nm']);
	$pr = trim($_POST['price']);
	$valid = true;

	// Validation
	if (empty($fnm)) {
		$msg_img = "Please select an image.";
		$valid = false;
	}
	if (empty($nm)) {
		$msg_name = "Please enter a name.";
		$valid = false;
	}
	if (empty($pr)) {
		$msg_price = "Please enter a price.";
		$valid = false;
	} elseif (!is_numeric($pr)) {
		$msg_price = "Price must be numeric.";
		$valid = false;
	}

	if ($valid) {
		move_uploaded_file($_FILES["image"]["tmp_name"], "../images/" . $fnm);
		// session_start();
		if (isset($_SESSION['admin'])) {
			$qry1 = mysqli_query($con, "INSERT INTO otherevent(img, nm, price) VALUES ('$fnm', '$nm', $pr)");
			if ($qry1) {
				echo "<script>
					setTimeout(() => {
						Swal.fire({
							title: 'Success!',
							text: 'Event added successfully!',
							icon: 'success',
							confirmButtonText: 'OK'
						}).then(() => {
							window.location='other_disp.php';
						});
					}, 100);
				</script>";
			} else {
				echo "<script>
					setTimeout(() => {
						Swal.fire({
							title: 'Error!',
							text: 'Failed to add event. Please try again.',
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}, 100);
				</script>";
			}
		}
	}
}
?>

<!-- Include SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="codes">
	<div class="container">
		<h3 class='w3ls-hdg' align="center">ADD OTHER EVENTS</h3>
		<div class="grid_3 grid_4">
			<div class="tab-content">
				<div class="tab-pane active" id="horizontal-form">
					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
						
						<!-- Image Input -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Enter Image</label>
							<div class="col-sm-8">
								<input type="file" name="image" class="form-control1">
								<?php if ($msg_img) echo "<span style='color:red;'>$msg_img</span>"; ?>
							</div>
						</div>

						<!-- Price Input -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Enter Price</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="price" placeholder="Theme Price">
								<?php if ($msg_price) echo "<span style='color:red;'>$msg_price</span>"; ?>
							</div>
						</div>

						<!-- Name Input -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Enter Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="nm" placeholder="Theme Name">
								<?php if ($msg_name) echo "<span style='color:red;'>$msg_name</span>"; ?>
							</div>
						</div>

						<!-- Buttons -->
						<div class="contact-w3form" align="center">
							<input type="submit" name="submit" class="btn btn-success" value="SEND">
							<input type="button" value="DISPLAY" class="btn my" onClick="javascript:location.href='other_disp.php'" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once("footer.php"); ?>
