<?php 
include("header.php");
include('Database/connect.php');

$id = $_GET['id'];	

if (isset($_POST['submit'])) {
    // Fetch selected birthday record
    $list = mysqli_query($con, "SELECT * FROM birthday WHERE id = $id");
    $q = mysqli_fetch_row($list);
    
    if ($q) {
        $id = $q[0];
        $image = $q[1];
        $name = $q[2];
        $price = $q[3];

        // Clear old data
        mysqli_query($con, "TRUNCATE TABLE temp");
        mysqli_query($con, "DELETE FROM booking"); // ✅ fixed syntax

        // Insert new record
        $qr1 = mysqli_query($con, "INSERT INTO temp VALUES('$id', '$image', '$name', $price)");
        
        if ($qr1) {
            echo "<script>window.location.assign('cart.php');</script>";	
        } else {
            echo "<script>alert('Not added to cart');</script>";	
        }
    }
}
?>

<?php
$list = mysqli_query($con, "SELECT * FROM birthday WHERE id = $id");				
while ($q = mysqli_fetch_row($list)) {
?>
<!-- modal -->
<div role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">	
                <a href="gallery.php">BACK TO BIRTHDAY</a>					
            </div>
            <form method="post">
                <div class="modal-body">
                    <img src="images/<?php echo $q[1]; ?>" alt="img" height="300" width="545"> 
                    <p>
                    <br/>Name : <?php echo $q[2]; ?><br/>
                    Price : <?php echo $q[3]; ?><br/>
                    <input type='submit' name='submit' value='BOOK NOW' class='btn my'/>
                    </p>
                </div>
            </form>
        </div> 
    </div>
</div><br/><br><br>
<!-- //modal -->  
<?php } ?>
<?php include("footer.php"); ?>
