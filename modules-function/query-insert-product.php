<?php
require_once "db-connect.php";
require_once "convertion-price.php";


function insertDataLaptop($laptopName, $laptopPrice, $laptopProducent, $laptopScreen, $laptopImage)
{

    global $con;

    if (!$laptopImage) {
        return false;
    }

    $intLaptopPrice = convertionPrice($laptopPrice);

    $sql = "INSERT INTO laptops VALUES ('', '$laptopName', '$intLaptopPrice', '$laptopProducent', '$laptopScreen', '$laptopImage')";

    if (mysqli_query($con, $sql)) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Tambah Data',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "../../index.php";
            })
        </script>
        
        label;
    } else {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Data',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href = "../../index.php";
            })
        </script>
        label;
    }

    mysqli_close($con);
}
