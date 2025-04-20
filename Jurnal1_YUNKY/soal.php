<?php
// **********************  1  **************************  
// Inisialisasi variabel untuk menyimpan nilai input dan error
$nama = $email = $nim = $jurusan = $fakultas = "";
$namaErr = $emailErr = $nimErr = $jurusanErr = $fakultasErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // **********************  2  **************************  
    // Validasi Nama
    if (empty($_POST["nama"])) {
        $namaErr = "Nama wajib diisi.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/",$nama)) {
        $namaErr = "Nama hanya boleh berisi huruf dan spasi.";
    } else {
        $nama = htmlspecialchars($_POST["nama"]);
    }

    // **********************  3  **************************  
    // Validasi Email
    if (empty($_POST["email"])) {
        $emailErr = "Email wajib diisi.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid.";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // **********************  4  **************************  
    // Validasi NIM
    if (empty($_POST["nim"])) {
        $nimErr = "NIM wajib diisi.";
    } elseif (!ctype_digit($_POST["nim"])) {
        $nimErr = "NIM hanya boleh berisi angka.";
    } else {
        $nim = htmlspecialchars($_POST["nim"]);
    }

    // **********************  5  **************************  
    // Validasi Jurusan
    if (empty($_POST["jurusan"])) {
        $jurusanErr = "Jurusan wajib diisi.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["jurusan"])) {
        $jurusanErr = "Jurusan hanya boleh berisi huruf dan spasi.";
    } else {
        $jurusan = htmlspecialchars($_POST["jurusan"]);
    }

    // **********************  6  **************************  
    // Validasi Fakultas
    if (empty($_POST["fakultas"])) {
        $fakultasErr = "Fakultas wajib diisi.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["fakultas"])) {
        $fakultasErr = "Fakultas hanya boleh berisi huruf dan spasi.";
    } else {
        $fakultas = htmlspecialchars($_POST["fakultas"]);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Mahasiswa Baru</title>
    <link rel="stylesheet" href="styless.css">  
</head>
<body>
    <div class="container">
        <img src="https://cybernetics.rg.telkomuniversity.ac.id/wp-content/uploads/sites/11/2017/04/logo_eadLab-768x216.jpg" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <?php if (!empty($namaErr) || !empty($emailErr) || !empty($nimErr) || !empty($jurusanErr) || !empty($fakultasErr)) { ?>
            <div class="alert alert-danger">
                <strong>Kesalahan!</strong> Harap perbaiki data yang salah.
            </div>
            <?php } else { ?>
            <div class="alert alert-success">
                <strong>Berhasil!</strong> Data pendaftaran telah diterima.
            </div>
            <?php } ?>
        <?php } ?>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>">
                <span class="error"><?php echo $nimErr ? "* $nimErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" id="jurusan" name="jurusan" value="<?php echo $jurusan; ?>">
                <span class="error"><?php echo $jurusanErr ? "* $jurusanErr" : ""; ?></span>
            </div>

            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" id="fakultas" name="fakultas" value="<?php echo $fakultas; ?>">
                <span class="error"><?php echo $fakultasErr ? "* $fakultasErr" : ""; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Daftar</button>
            </div>
        </form>
    </div>

    <!-- **********************  8  ************************** -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($namaErr) && empty($emailErr) && empty($nimErr) && empty($jurusanErr) && empty($fakultasErr)) { ?>
    <div class="container">
        <h3>Data Pendaftaran</h3>
        <div class="table-container">
            <table border="1">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>NIM</th>
                    <th>Jurusan</th>
                    <th>Fakultas</th>
                </tr>
                <tr>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $nim; ?></td>
                    <td><?php echo $jurusan; ?></td>
                    <td><?php echo $fakultas; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php } ?>
</body>
</html>
