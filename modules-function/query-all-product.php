<?php
require_once "db-connect.php";

function displayAllLaptops(string $query)
{
    global $con;

    $result = mysqli_query($con, $query);
    $laptops = [];

    if (mysqli_num_rows($result) > 0) {
        // dapatkan data setiap baris
        while ($row = mysqli_fetch_assoc($result)) {
            $laptops[] = $row;
        }

        return $laptops;
    } else {
        return "<tr><td colspan='8' class='text-secondary text-center'><h2 class='h1'>Tidak ada data</h2></td></tr>";
    }
}
