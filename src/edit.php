<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}

require_once __DIR__ . "/../modules-function/query-all-product.php";

if (!isset($_POST["laptopID"])) {
    header("Location: ../index.php");
}

$idLaptop = $_POST["laptopID"];

$laptop = displayAllLaptops("SELECT * FROM laptops WHERE id = '$idLaptop'")[0];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>

    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row p-3">
            <h2 class="text-capitalize px-2">update data laptop</h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form class="p-3" action="edit/valid.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $laptop["id"] ?>">
                    <input type="hidden" class="form-control" id="old-image" name="old-image" value="<?= $laptop["gambar"] ?>">

                    <div class="mb-3">
                        <label for="name" class="form-label">nama laptop</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $laptop["nama"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">harga</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $laptop["harga"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="producent" class="form-label">produsen</label>
                        <input type="text" class="form-control" id="producent" name="producent" value="<?= $laptop["produsen"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="screen" class="form-label">ukuran layar</label>
                        <input type="text" class="form-control" id="screen" name="screen" value="<?= $laptop["ukuran_layar"] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">upload gambar barang</label>
                        <input type="file" class="form-control" id="image" name="image" value="">
                        <img width="100" class="img-fluid d-block" src="../public/images/<?= $laptop["gambar"] ?>" alt="<?= $laptop["gambar"] ?>">
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success">ubah</button>
                        <a href="../index.php" role="button" class="btn btn-warning">batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<script>
    function formatRupiah(inputValue) {
        let isNumber = inputValue.replace(/[^\d]/g, '');

        const putToArray = [];

        putToArray.push(isNumber);

        const arrayToString = putToArray.join();

        if (arrayToString === '') {
            return '';
        }

        return Number(arrayToString).toLocaleString('id-ID');
    }
</script>

<script>
    function InputIDR(element) {
        element.addEventListener("input", function() {
            element.value = formatRupiah(this.value)
        })
    }
</script>

<script>
    InputIDR(document.getElementById("price"))
</script>

</html>