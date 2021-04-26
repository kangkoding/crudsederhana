<!DOCTYPE html>
<html>

<head>
    <title>Latihan CRUD PHP Sederhana</title>
</head>

<body>
    <h3>CRUD Sederhana</h3>

    <h4><a href="create.php">Tambah Data</a></h4> <!-- Link menuju halaman tambah data -->

    <table border=1>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tempat</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>No HP</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        include "koneksi.php"; // Panggil file koneksi.php kita

        $perintah = "SELECT * FROM siswa";

        $hasil = mysqli_query($konek, $perintah); // $kone mengambil variabel dari file koneksi.php

        $no = 0;

        while ($data = mysqli_fetch_array($hasil)) { // Lakukan perulangan untuk menampilkan data
            $no++; // Lakukan increment atau penambahan untuk penomoran data
        ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama']; ?></td> <!-- Variabel didalam $data[''] disamakan dengan nama field di database -->
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['tempat']; ?></td>
                    <td><?php echo $data['ttl']; ?></td>
                    <td><?php echo $data['agama']; ?></td>
                    <td><?php echo $data['no_hp']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['foto']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $data['id']; ?>">Update</a>
                        <br>
                        <a href="delete.php?id=<?php echo $data['id']; ?>">Delete</a>
                    </td>
                </tr>
            </tbody>
        <?php
        }
        ?>
    </table>
</body>

</html>