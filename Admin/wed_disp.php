<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$list = mysqli_query($con, "SELECT * FROM wedding");
?>

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class='codes'>
    <div class='container'>
        <a href='add_wed.php' class="btn btn-primary" style="margin-bottom:10px;">BACK</a>
        <h3 class='w3ls-hdg' align='center'>Wedding Display</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th colspan="2" style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($q = mysqli_fetch_assoc($list)) { ?>
                        <tr>
                            <td><span class="badge"><?php echo $q['id']; ?></span></td>
                            <td><img src="../images/<?php echo htmlspecialchars($q['img']); ?>" height="150" width="220"></td>
                            <td><?php echo htmlspecialchars($q['nm']); ?></td>
                            <td><?php echo htmlspecialchars($q['price']); ?></td>
                            <td><a href="wed_edit.php?id=<?php echo $q['id']; ?>"><u>Edit</u></a></td>
                            <td>
							<a href="#" class="delete-btn" data-id="<?php echo $q['id']; ?>"><u>Delete</u></a></td>
							<!-- <button class="btn btn-danger delete-btn" data-id="<?php echo $q['id']; ?>">Delete</button> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// ✅ SweetAlert2 Custom Delete Confirmation
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to delete page
                window.location.href = 'wed_delete.php?id=' + id;
            }
        });
    });
});
</script>

<?php include_once("footer.php"); ?>
