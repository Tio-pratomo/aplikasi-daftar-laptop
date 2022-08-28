<?php

/**
 * MELAKUKAN KONEKSI KE DATABASE
 */


// jika tidak terkoneksi dengan baik
if (mysqli_connect_errno()) {
    echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    exit();
}

$con = mysqli_connect('localhost', 'root', '', 'php_dasar_wpu');
