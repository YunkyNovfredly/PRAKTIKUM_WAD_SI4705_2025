<?php
// Inisialisasi variabel untuk input dan error
$nama = $email = $nim = "";
$namaErr = $emailErr = $nimErr = "";
$formSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Nama
    $nama = trim($_POST["nama"]);
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    } else {
        $nama = htmlspecialchars($nama);
    }

    // Validasi Email
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    } else {
        $email = htmlspecialchars($email);
    }

    // Validasi NIM
    $nim = trim($_POST["nim"]);
    if (empty($nim)) {
        $nimErr = "NIM wajib diisi";
    } elseif (!ctype_digit($nim)) {
        $nimErr = "NIM harus berupa angka";
    } else {
        $nim = htmlspecialchars($nim);
    }

    // Cek apakah semua input valid
    if (empty($namaErr) && empty($emailErr) && empty($nimErr)) {
        $formSuccess = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bingung sama SI kenapa semua harus dipelajari T_T</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <img src="https://cybernetics.rg.telkomuniversity.ac.id/wp-content/uploads/sites/11/2017/04/logo_eadLab-768x216.jpg" alt="Logo" class="logo">
        <h2>Formulir Pendaftaran Mahasiswa Baru</h2>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <div class="alert <?php echo $formSuccess ? 'alert-success' : 'alert-danger'; ?>">
                <strong><?php echo $formSuccess ? 'Berhasil!' : 'Kesalahan!'; ?></strong>
                <?php echo $formSuccess ? 'Data pendaftaran telah diterima.' : 'Harap perbaiki data yang salah.'; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>">
                <span class="error"><?php echo $namaErr; ?></span>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $emailErr; ?></span>
            </div>

            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?php echo $nim; ?>">
                <span class="error"><?php echo $nimErr; ?></span>
            </div>

            <div class="button-container">
                <button type="submit">Daftar</button>
            </div>
        </form>
    </div>
</body>
</html>
