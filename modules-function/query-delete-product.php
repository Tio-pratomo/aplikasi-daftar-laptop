<?php
require_once "db-connect.php";

function deleteDataLaptop(string $query)
{

    global $con;

    if (mysqli_query($con, $query)) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Menghapus Data',
                showConfirmButton: false,
                timer: 1000
            }).then(function() {
                window.location.href = "../index.php";
            })
        </script>
        
        label;
    } else {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menghapus Data',
                showConfirmButton: false,
                timer: 1000
            }).then(function() {
                window.location.href = "../index.php";
            })
        </script>
        label;
    }

    mysqli_close($con);
}
