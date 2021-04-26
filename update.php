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

    <?php
    include "koneksi.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id']; // Ambil id dari url 

        $perintahSql = "SELECT * FROM siswa WHERE id = $id";

        $hasil = mysqli_query($konek, $perintahSql);

        $data = mysqli_fetch_assoc($hasil); // Tangkap data menjadi array asosiatif
    }

    ?>

    <form method="post" name="form" enctype="multipart/form-data">
        <!-- Tambahkan enctype="multipart/form-data" karena kita melakukan upload file foto -->

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <input type="hidden" name="fotolama" value="<?php echo $data['foto']; ?>">

        <table>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" required></td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td><input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required></td>
            </tr>

            <tr>
                <td>Tempat</td>
                <td><input type="text" name="tempat" value="<?php echo $data['tempat']; ?>" required></td>
            </tr>

            <tr>
                <td>Tanggal Lahir</td>
                <td><input type="text" name="ttl" id="datepicker" value="<?php echo $data['ttl']; ?>" required></td>
            </tr>

            <tr>
                <td>Agama</td>
                <td>
                    <select name="agama" required>
                        <option>-- Pilih Agama --</option>
                        <option value="ISLAM" <?php if ($data['agama'] == 'ISLAM') {
                                                    echo 'selected';
                                                } ?>>ISLAM</option>
                        <option value="KRISTEN" <?php if ($data['agama'] == 'KRISTEN') {
                                                    echo 'selected';
                                                } ?>>KRISTEN</option>
                        <option value="KATOLIK" <?php if ($data['agama'] == 'KATOLIK') {
                                                    echo 'selected';
                                                } ?>>KATOLIK</option>
                        <option value="BUDHA" <?php if ($data['agama'] == 'BUDHA') {
                                                    echo 'selected';
                                                } ?>>BUDHA</option>
                        <option value="HINDU" <?php if ($data['agama'] == 'HINDU') {
                                                    echo 'selected';
                                                } ?>>HINDU</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>No HP</td>
                <td><input type="number" name="no_hp" value="<?php echo $data['no_hp']; ?>" required></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $data['email']; ?>" required></td>
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
    include "koneksi.php";

    if (isset($_POST['submit']) and isset($_FILES['foto']['name'])) { // Lakukan cek apakah tombol "simpan" ditekan dan foto dipilih
        $id = $_POST['id'];
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
            unlink($lokasiUpload . $_POST['fotolama']);

            $perintahSql = "UPDATE siswa SET nama='$nama',alamat='$alamat',tempat='$tempat',ttl='$ttl',agama='$agama',no_hp='$no_hp',email='$email',foto='$namaFoto' WHERE id = $id";

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