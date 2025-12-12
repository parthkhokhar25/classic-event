<?php
include_once('../Database/connect.php');
include_once('session.php');
include_once("header.php");

$a = mysqli_query($con, 'SELECT * FROM feedback');

echo "
<div class='codes'>
    <div class='container'>
        <h3 class='w3ls-hdg' align='center'>Feed Back</h3>
        <div class='grid_3 grid_5'><br/>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Comment</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
";

while ($r = mysqli_fetch_row($a)) {
    echo "
        <tr>
            <td>$r[1]</td>
            <td>$r[2]</td>
            <td>$r[3]</td>
            <td><u><a href='#' class='delete-btn' data-id='$r[0]'>Delete</a></u></td>
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
                text: 'This feedback will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete page
                    window.location = 'delete_feedback.php?id=' + id;
                }
            });
        });
    });
});
</script>
