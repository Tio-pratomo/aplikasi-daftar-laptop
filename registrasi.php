<?php
require_once __DIR__ . "\\modules-function\\registration.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8">
                <h2 class="my-3">Registrasi</h2>

                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="user name" required>
                        <label for="username">user name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                        <label for="password">password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password2" id="password2" placeholder="konfirmasi password" required>
                        <label for="password2">konfirmasi password</label>
                    </div>
                    <div class="mb-3">
                        <small>jika anda sudah registrasi, silahkan ke menu login klik, <a href="login.php">login</a></small>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="registrasi" value="registered" class="btn btn-success">registrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    $submitRegister = $_POST["registrasi"] ?? false;

    if ($submitRegister === "registered") {
        registration($_POST);
    }

    ?>
</body>

</html>