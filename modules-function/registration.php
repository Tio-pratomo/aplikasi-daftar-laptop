<?php
require_once "db-connect.php";

function registration(array $data)
{
    global $con;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($con, $data["password"]);
    $password2 = mysqli_real_escape_string($con, $data["password2"]);

    // cek username yang sama di dalam database
    $userNameDB = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($userNameDB)) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'username sudah dibuat'
            })
        </script>
        label;
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Konfirmasi Password dengan Password yang anda masukkan tidak sama'
            })
        </script>
        label;
        return false;
    }
    // enkripsi password
    $encryptPassword = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database

    if (mysqli_query($con, "INSERT INTO users VALUES ('', '$username', '$encryptPassword')")) {
        echo <<< label
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Berhasil registrasi'
            })
        </script>
        label;
    } else {
        $theError = mysqli_error($con);
        echo <<< label
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{$theError}'
            })
        </script>
        label;
    }

    mysqli_close($con);
}
