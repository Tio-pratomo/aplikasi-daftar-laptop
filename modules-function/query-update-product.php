<?php
require_once "db-connect.php";
require_once "upload.php";
require_once "convertion-price.php";

/* 
 * MELAKUKAN UPDATE PADA DATABASE
 */

function updateDataLaptop()
{

    $laptopId = $_POST["id"];
    $laptopName = htmlspecialchars($_POST["name"] ?? "");
    $laptopPrice = htmlspecialchars($_POST["price"] ?? "");
    $laptopProducent = htmlspecialchars($_POST["producent"] ?? "");
    $laptopScreen = htmlspecialchars($_POST["screen"] ?? "");
    $oldImage = $_POST["old-image"];

    $intLaptopPrice = convertionPrice($laptopPrice);

    global $con;

    if ($_FILES["image"]["error"] === 4) {
        $theImage = $oldImage;
    } else {
        $theImage = upload();
        unlink("../../public/images/{$oldImage}");
    }

    $sql = "UPDATE laptops SET nama = '$laptopName', harga = '$intLaptopPrice', produsen = '$laptopProducent', ukuran_layar = '$laptopScreen', gambar = '$theImage' WHERE id = '$laptopId' ";

    if (mysqli_query($con, $sql)) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Ubah Data',
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
                title: 'Gagal Mengubah Data',
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
