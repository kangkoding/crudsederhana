<?php

$host = "localhost";
$username = "root"; // Username PHPMyAdmin
$password = ""; // Password PHPMyAdmin
$database = "latihancrud"; // Nama Database

$konek = mysqli_connect($host, $username, $password, $database);

// if ($konek) {
//     echo "Koneksi Berhasil";
// } else {
//     echo "Koneksi Gagal" . mysqli_connect_error();
// }
