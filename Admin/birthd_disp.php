<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$list = mysqli_query($con, "SELECT * FROM birthday");

echo "
<div class='codes'>
    <div class='container'>
     <a href='add_birthd.php' class='btn btn-primary text-dark' style='margin-bottom:10px;'>BACK</a>
    
        <h3 class='w3ls-hdg' align='center'>Birthday Display</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
";

while ($q = mysqli_fetch_row($list)) {
    echo "
        <tr>
            <td><span class='badge'>$q[0]</span></td>
            <td><img src='../images/$q[1]' height='150' width='220'></td>
            <td>$q[2]</td>
            <td>$q[3]</td>
            <td><u><a href='birthd_edit.php?id=$q[0]'>Edit</a></u></td>
            <td><u><a href='#' class='delete-btn' data-id='$q[0]'>Delete</a></u></td>
        </tr>
    ";
}

echo "
                </tbody>
            </table>
        </div>
    </div>
</div>
";

include_once("footer.php");
?>

<!-- SweetAlert2 CDN -->
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete page
                    window.location = 'birthd_delete.php?id=' + id;
                }
            });
        });
    });
});
</script>
