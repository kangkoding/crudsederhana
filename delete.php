<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $ambilFoto = mysqli_query($konek, "SELECT foto FROM siswa WHERE id = $id");

    $dataFoto = mysqli_fetch_array($ambilFoto);

    $perintahSql = "DELETE FROM siswa WHERE id = $id";

    $hasil = mysqli_query($konek, $perintahSql);

    if ($hasil) {
        unlink('upload/' . $dataFoto['foto']);
        header('Location:index.php');
    } else {
        echo "<script>alert('Gagal')</script>";
    }
}
