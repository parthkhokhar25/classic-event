<?php
include('Database/connect.php');
include('session.php');		
include("header.php");

$nameErr = $emailErr = $moErr = $dateErr = "";
$name = $email = $mo = $date = "";
$error = false;
$modalTitle = $modalMsg = "";
$redirect = false;

// Fetch temp data
$q = mysqli_query($con, "SELECT * FROM temp");
$row = mysqli_fetch_row($q);
if ($row) {
    $id = $row[0];
    $image = $row[1];
    $thmname = $row[2];
    $price = $row[3];
}

// When form is submitted
if (isset($_POST['submit'])) {
    $name = trim($_POST['nm']);
    $email = trim($_POST['email']);
    $mo = trim($_POST['mo']);
    $date = trim($_POST['date']);

    // Validation
    if (empty($name)) {
        $nameErr = "Please enter your name.";
        $error = true;
    }
    if (empty($email)) {
        $emailErr = "Please enter your email.";
        $error = true;
    }
    if (empty($mo)) {
        $moErr = "Please enter your mobile number.";
        $error = true;
    }
    if (empty($date)) {
        $dateErr = "Please select an event date.";
        $error = true;
    }

    // If no errors
    if (!$error) {
        $q = mysqli_query($con, "SELECT * FROM temp");
        while ($res = mysqli_fetch_array($q)) {
            $id = $res[0];
            $im = $res[1];
            $nm = $res[2];
            $pri = $res[3];

            $q1 = mysqli_query($con, "INSERT INTO booking(nm,email,mo,theme,thm_nm,price,date)
                    VALUES('$name','$email','$mo','$im','$nm','$pri','$date')");

            if ($q1) {
                $modalTitle = "Success 🎉";
                $modalMsg = "Your Event is Booked Successfully!";
                $redirect = true;
            } else {
                $modalTitle = "Error ❌";
                $modalMsg = "Sorry, your booking could not be completed. Please try again later.";
            }
        }
    }
}
?>

<style>
.error { color: red; font-size: 14px; }

/* ✅ Custom Modal Box CSS */
.modal {
  display: none; 
  position: fixed; 
  z-index: 9999; 
  left: 0; 
  top: 0; 
  width: 100%; 
  height: 100%; 
  background-color: rgba(0,0,0,0.4);
}
.modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 20px;
  border-radius: 10px;
  width: 30%;
  text-align: center;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}
.close {
  color: #aaa;
  float: right;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
}
.close:hover { color: red; }
.btn-primary {
  background-color: #ff6600;
  color: white;
  border: none;
  padding: 8px 18px;
  border-radius: 5px;
  cursor: pointer;
}
.btn-primary:hover { background-color: #e55b00; }
</style>

<!-- ✅ Custom Modal Box HTML -->
<div id="customModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3 id="modalTitle"></h3>
    <p id="modalMessage"></p>
    <button id="okBtn" class="btn btn-primary">OK</button>
  </div>
</div>

<div class="codes">
<div class="container"> 
<h3 class='w3ls-hdg' align="center">BOOKING</h3>
<div class="grid_3 grid_4">
    <div class="tab-content">
        <div class="tab-pane active" id="horizontal-form">
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1" name="nm"
                               value="<?php echo htmlspecialchars($name); ?>"
                              placeholder="Name">
                        <span class="error"><?php echo $nameErr; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1 input-sm" name="email"
                               value="<?php echo htmlspecialchars($email); ?>"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                               title="Enter Proper Email Id" placeholder="Email">
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile no</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control1 input-sm" name="mo"
                               value="<?php echo htmlspecialchars($mo); ?>"
                               pattern="[7-9]{1}[0-9]{9}" title="Only Numbers"
                               maxlength="10" placeholder="Mobile no">
                        <span class="error"><?php echo $moErr; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Your Theme :</label>
                    <div class="col-sm-8">
                        <img src="./images/<?php echo $image; ?>" height="200" width="300"/>
                    </div>		
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Theme Name :</label>
                    <div class="col-sm-8">
                        <input disabled type="text" class="form-control1" value="<?php echo $thmname; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Theme Price :</label>
                    <div class="col-sm-8">
                        <input disabled type="text" class="form-control1" value="<?php echo $price; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Event Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control1 input-sm" name="date"
                               value="<?php echo htmlspecialchars($date); ?>" >
                        <span class="error"><?php echo $dateErr; ?></span>
                    </div>
                </div>

                <div class="contact-w3form" align="center">
                    <input type="submit" name="submit" class="btn" value="BOOK">
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<?php include_once("footer.php"); ?>

<!-- ✅ Modal JS -->
<script>
function showModal(title, message, redirect=false) {
  const modal = document.getElementById("customModal");
  document.getElementById("modalTitle").innerText = title;
  document.getElementById("modalMessage").innerText = message;
  modal.style.display = "block";

  document.getElementById("okBtn").onclick = function() {
    modal.style.display = "none";
    if (redirect) window.location = "index.php";
  };
  document.querySelector(".close").onclick = function() {
    modal.style.display = "none";
  };
  window.onclick = function(e) {
    if (e.target == modal) modal.style.display = "none";
  };
}

// ✅ Auto-trigger modal if PHP sets data
<?php if (!empty($modalTitle) && !empty($modalMsg)) : ?>
window.onload = function() {
    showModal("<?php echo $modalTitle; ?>", "<?php echo $modalMsg; ?>", <?php echo $redirect ? 'true' : 'false'; ?>);
};
<?php endif; ?>
</script>
