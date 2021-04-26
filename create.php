<!DOCTYPE html>
<html>

<head>
    <title>Latihan CRUD PHP Sederhana</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd'
            }).val();
        });
    </script>
</head>

<body>
    <h3>CRUD Sederhana</h3>

    <form method="post" name="form" enctype="multipart/form-data">
        <!-- Tambahkan enctype="multipart/form-data" karena kita melakukan upload file foto -->
        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" required></td>
            </tr>

            <tr>
                <td>Tempat</td>
                <td><input type="text" name="tempat" required></td>
            </tr>

            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="text" name="ttl" id="datepicker" required></td>
            </tr>

            <tr>
                <td>Agama</td>
                <td>
                    <select name="agama" required>
                        <option>-- Pilih Agama --</option>
                        <option value="ISLAM">ISLAM</option>
                        <option value="KRISTEN">KRISTEN</option>
                        <option value="KATOLIK">KATOLIK</option>
                        <option value="BUDHA">BUDHA</option>
                        <option value="HINDU">HINDU</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>No HP</td>
                <td><input type="number" name="no_hp" required></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required></td>
            </tr>

            <tr>
                <td>Foto</td>
                <td><input type="file" name="foto" required></td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Simpan" name="submit">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

    <?php
    include "koneksi.php"; // Panggil file koneksi.php kita

    if (isset($_POST['submit']) and isset($_FILES['foto']['name'])) { // Lakukan cek apakah tombol "simpan" ditekan dan foto dipilih
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $tempat = $_POST['tempat'];
        $ttl = $_POST['ttl'];
        $agama = $_POST['agama'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];
        $foto = $_FILES['foto']['name']; // Kita ambil nama file yang dipilih
        $tmpFoto = $_FILES['foto']['tmp_name']; // Kita ambil temporary

        $namaFoto = $nama . '-' . $foto; // Kita ubah nama file sesuai nama siswa

        $lokasiUpload = 'upload/'; // Karena kita sudah membuat folder dengan nama upload

        $prosesUpload = move_uploaded_file($tmpFoto, $lokasiUpload . $namaFoto);

        if ($prosesUpload) { // Kita cek apakah proses upload berhasil
            $perintahSql = "INSERT INTO siswa (nama,alamat,tempat,ttl,agama,no_hp, email, foto) VALUES ('$nama','$alamat','$tempat','$ttl','$agama','$no_hp','$email','$namaFoto')";

            $hasil = mysqli_query($konek, $perintahSql);

            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<script>alert('Gagal')</script>";
            }
        }
    }
    ?>
</body>

</html>