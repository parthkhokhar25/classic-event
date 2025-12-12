<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$list = mysqli_query($con, "SELECT * FROM booking");

echo "
<div class='codes'>
    <div class='container'>
        <h3 class='w3ls-hdg' align='center'>ORDERS</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Theme</th>
                        <th>Theme Name</th>
                        <th>Price</th>
                        <th>Event Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
";

while ($q = mysqli_fetch_row($list)) {
    echo "
        <tr>
            <td><span class='badge'>$q[0]</span></td>
            <td>$q[1]</td>
            <td>$q[2]</td>
            <td>$q[3]</td>
            <td><img src='../images/$q[4]' height='150' width='220'></td>
            <td>$q[5]</td>
            <td>$q[6]</td>
            <td>$q[7]</td>
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
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This booking record will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = 'delete_book.php?id=' + id;
                }
            });
        });
    });
});
</script>
