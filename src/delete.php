<?php
require_once __DIR__ . "../../modules-function/query-delete-product.php";
require_once __DIR__ . "../../modules-function/query-all-product.php";

if (!isset($_POST["delete"])) {
    header("Location: ../index.php");
    exit();
}

$deleteId = $_POST["delete"];
$sql = "DELETE FROM laptops WHERE id = '$deleteId'";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>

<body>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    $laptop = displayAllLaptops("SELECT * FROM laptops WHERE id = '$deleteId'")[0];

    unlink("../public/images/{$laptop["gambar"]}");
    deleteDataLaptop($sql);


    ?>


</body>

</html>