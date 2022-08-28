<?php
require_once __DIR__ . "../../../modules-function/query-update-product.php";


if (
    !isset($_POST["name"]) || !isset($_POST["price"]) || !isset($_POST["producent"]) || !isset($_POST["screen"])
) {
    header("Location: ../../index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valid</title>
</head>

<body>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    updateDataLaptop();

    ?>



</body>

</html>