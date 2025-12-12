<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$list = mysqli_query($con, "SELECT * FROM anniversary");
?>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class='codes'>
    <div class='container'>
        <a href='add_anni.php' class="btn btn-primary" style="margin-bottom:10px;">BACK</a>
        <h3 class='w3ls-hdg' align='center'>Anniversary Display</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr align="center">
                        <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($q = mysqli_fetch_row($list)) {
                        echo "
                        <tr align='center'>
                            <td><span class='badge'>{$q[0]}</span></td>
                            <td><img src='../images/{$q[1]}' height='150' width='220'></td>
                            <td>{$q[2]}</td>
                            <td>{$q[3]}</td>
                            <td><a href='anni_edit.php?id={$q[0]}'><u>Edit</u></a></td>
                            <td><a href='javascript:void(0);' onclick='confirmDelete({$q[0]});'><u>Delete</u></a></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// SweetAlert Confirm Box for Delete
function confirmDelete(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "Do you really want to delete this anniversary theme?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to PHP delete file
            window.location.href = "anni_delete.php?id=" + id;
        }
    });
}
</script>

<?php include_once("footer.php"); ?>
