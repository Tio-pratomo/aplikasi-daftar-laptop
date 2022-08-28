<?php
session_start();
require_once __DIR__ . "\\modules-function\\db-connect.php";

// cek cookie
if (isset($_COOKIE["ussd"]) && isset($_COOKIE["key"])) {
    $ussd = $_COOKIE["ussd"];
    $key = $_COOKIE["key"];

    // ambil username berdasarkan id
    $result = mysqli_query($con, "SELECT * FROM users WHERE id = '$ussd'");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash("sha256", $row["username"])) {
        $_SESSION["login"] = true;
    }
}



if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-lg-8">
                <h2 class="my-3">Login</h2>

                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="user name" required>
                        <label for="username">user name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password" required>
                        <label for="password">password</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <div class="mb-3">
                        <small>jika anda belum registrasi, harap registrasi terlebih dahulu, klik <a href="registrasi.php">registrasi</a></small>

                    </div>

                    <div class="mb-3">
                        <button type="submit" name="login" value="login" class="btn btn-success">login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    $loged = $_POST["login"] ?? false;

    if ($loged) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($con, "SELECT * FROM users WHERE username = '$username'");


        /* 
         * Cek apakah username yang diinput
         * sama dengan username di database
         */
        if (mysqli_num_rows($result) === 1) {
            // cek passwordnya
            $row = mysqli_fetch_assoc($result);

            if (password_verify($password, $row["password"])) {
                // cek session
                $_SESSION["login"] = true;

                // cek remember me (cookie)
                if (isset($_POST["remember"])) {
                    // buat cookie-nya
                    setcookie("ussd", $row["id"], time() + 86_400);
                    setcookie("key", hash("sha256", $row["username"]), time() + 86_400);
                }

                header("Location: index.php");
                exit;
            }
        }

        $error = true;

        if ($error) {
            echo <<< label
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'username atau password salah',
                    color: "#EE6357",
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
            label;
        }
    }

    ?>
</body>

</html>