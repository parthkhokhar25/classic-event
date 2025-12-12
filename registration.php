<?php
include_once("header.php");
include_once("Database/connect.php");
@session_start();

if(isset($_POST['submit'])) {

    $name = trim($_POST['nm']);
    $surnm = trim($_POST['surnm']);
    $unm = trim($_POST['unm']);
    $email = trim($_POST['email']);
    $pswd = trim($_POST['pswd']);
    $mo = trim($_POST['mo']);
    $gen = isset($_POST['gen']) ? $_POST['gen'] : "";
    $adrs = trim($_POST['adrs']);

    // Empty field validation
    if(empty($name) || empty($surnm) || empty($unm) || empty($email) 
        || empty($pswd) || empty($mo) || empty($gen) || empty($adrs)) {

        echo "<script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Fields!',
                    text: 'Please fill all required fields including gender.',
                    confirmButtonColor: '#d33'
                });
            }, 100);
        </script>";

    }
    elseif(!preg_match('/^[0-9]{10}$/',$mo)) {
        echo "<script>
            setTimeout(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Mobile Number!',
                    text: 'Please enter a valid 10-digit mobile number.',
                    confirmButtonColor: '#d33'
                });
            }, 100);
        </script>";
    }
    else {

        // Check username exists
        $q = mysqli_query($con,"SELECT unm FROM registration WHERE unm='$unm'");
        if(mysqli_num_rows($q) > 0) {
            echo "<script>
                setTimeout(() => {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Username Exists',
                        text: 'This username is already taken. Try another one!',
                        confirmButtonColor: '#f39c12'
                    });
                }, 100);
            </script>";

        } else {

            // Insert query including gender
            $qry = mysqli_query($con,"
                INSERT INTO registration (nm, surnm, unm, email, pswd, mo, gen, adrs)
                VALUES ('$name', '$surnm', '$unm', '$email', '$pswd', '$mo', '$gen', '$adrs')
            ");

            if($qry) {

                mysqli_query($con, "INSERT INTO login (unm, pswd) VALUES ('$unm','$pswd')");

                echo "<script>
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                            text: 'Please login to your account.',
                            confirmButtonColor: '#28a745'
                        }).then(() => {
                            window.location.assign('login.php');
                        });
                    }, 100);
                </script>";

            } else {
                echo "<script>
                    setTimeout(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again later.',
                            confirmButtonColor: '#d33'
                        });
                    }, 100);
                </script>";
            }
        }
    }
}
?>

<!-- Registration Form -->
<div class="banner about-bnr">
	<div class="container"></div>
</div>

<div class="codes">
	<div class="container"> 
		<h2 class="w3ls-hdg" align="center">Registration Form</h2>
		<div class="grid_3 grid_4">
			<div class="tab-content">
				<div class="tab-pane active" id="horizontal-form">
				
					<form class="form-horizontal" action="" method="post" id="regForm">

						<!-- Name -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="nm" placeholder="Name">
								<small class="text-danger" id="error_nm"></small>
							</div>
						</div>

						<!-- Surname -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Surname</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="surnm" placeholder="Surname">
								<small class="text-danger" id="error_surnm"></small>
							</div>
						</div>

						<!-- Username -->
						<div class="form-group">
							<label class="col-sm-2 control-label">User Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="unm" placeholder="User Name">
								<small class="text-danger" id="error_unm"></small>
							</div>
						</div>

						<!-- Email -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Email</label>
							<div class="col-sm-8">
								<input type="email" class="form-control1" name="email" placeholder="Email">
								<small class="text-danger" id="error_email"></small>
							</div>
						</div>

						<!-- Password -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Password</label>
							<div class="col-sm-8">
								<input type="password" class="form-control1" name="pswd" placeholder="Password">
								<small class="text-danger" id="error_pswd"></small>
							</div>
						</div>

						<!-- Mobile -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Mobile No</label>
							<div class="col-sm-8">
								<input type="text" class="form-control1" name="mo" maxlength="10" placeholder="Mobile Number">
								<small class="text-danger" id="error_mo"></small>
							</div>
						</div>

						<!-- Gender -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Gender</label>
							<div class="col-sm-8">
								<label><input type="radio" name="gen" value="Male"> Male</label>&nbsp;&nbsp;
								<label><input type="radio" name="gen" value="Female"> Female</label>&nbsp;&nbsp;
								<label><input type="radio" name="gen" value="Other"> Other</label>
								<br>
								<small class="text-danger" id="error_gen"></small>
							</div>
						</div>

						<!-- Address -->
						<div class="form-group">
							<label class="col-sm-2 control-label">Address</label>
							<div class="col-sm-8">
								<textarea name="adrs" cols="50" rows="4" class="form-control1"></textarea>
								<small class="text-danger" id="error_adrs"></small>
							</div>
						</div>

						<!-- Submit -->
						<div class="contact-w3form" align="center">
							<input type="submit" name="submit" value="Register" class="btn btn-primary">
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- CLIENT-SIDE VALIDATION -->
<script>
document.getElementById("regForm").addEventListener("submit", function(e) {
    let valid = true;
    let fields = ["nm", "surnm", "unm", "email", "pswd", "mo", "adrs"];

    fields.forEach(field => {
        let input = document.getElementsByName(field)[0];
        let error = document.getElementById("error_" + field);
        if (input.value.trim() === "") {
            error.textContent = "This field is required";
            valid = false;
        } else {
            error.textContent = "";
        }
    });

    // Gender validation
    let genders = document.getElementsByName("gen");
    let genderSelected = false;
    for (let g of genders) {
        if (g.checked) genderSelected = true;
    }
    if (!genderSelected) {
        document.getElementById("error_gen").textContent = "Please select gender";
        valid = false;
    } else {
        document.getElementById("error_gen").textContent = "";
    }

    // Mobile validation
    let mo = document.getElementsByName("mo")[0].value.trim();
    if (mo !== "" && !/^[0-9]{10}$/.test(mo)) {
        document.getElementById("error_mo").textContent = "Please enter a valid 10-digit mobile number";
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
        Swal.fire({
            icon: "error",
            title: "Validation Error!",
            text: "Please correct the highlighted fields.",
            confirmButtonColor: "#d33"
        });
    }
});
</script>

<?php include_once("footer.php"); ?>
