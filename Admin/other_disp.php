<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$list = mysqli_query($con, "SELECT * FROM otherevent");
?>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class='codes'>
    <div class='container'>
        <a href='add_anni.php'>BACK</a>
        <h3 class='w3ls-hdg' align='center'>Other Events Display</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th colspan="2" align="center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($q = mysqli_fetch_row($list)) { ?>
                        <tr>
                            <td><span class="badge"><?php echo $q[0]; ?></span></td>
                            <td><img src="../images/<?php echo $q[1]; ?>" height="150" width="220"></td>
                            <td><?php echo $q[2]; ?></td>
                            <td><?php echo $q[3]; ?></td>
                            <td><u><a href="other_edit.php?id=<?php echo $q[0]; ?>">Edit</a></u></td>
                            <td>
                                <a href="javascript:void(0);" 
                                   onclick="confirmDelete(<?php echo $q[0]; ?>)">
                                   <u>Delete</u>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// SweetAlert2 custom confirm for delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This record will be permanently deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to delete page
            window.location.href = "other_delete.php?id=" + id;
        }
    });
}
</script>

<?php include_once("footer.php"); ?>
