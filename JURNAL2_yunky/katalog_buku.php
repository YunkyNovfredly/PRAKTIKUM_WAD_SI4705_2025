<?php
include 'connect.php';

// (1.) Cek Apakah ada data yang dikirim
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
// (2.) Validasi Input jika search input kurang dari 3 karakter
    // Hint : Gunakan strlen()
if (strlen($search) < 3) {
    isset ($_GET['search']) ? $_GET['search'] : '';
        echo "<script>alert('Search term must be at least 3 characters long');</script>";
    } 
// (3.) Validasi Input jika search input tidak alphanumeric
    // Hint : Gunakan preg_match()
 elseif (!preg_match("/^[a-zA]+$/", $search)) {
        echo "<script>alert('hanya dapat berisi huruf, angka, dan spasi.');</script>";
    } 

// (4.) Buat query untuk menampilkan data (Hint : gunakan query SELECT)
    $query = "SELECT * FROM buku WHERE judul LIKE '%$search%' OR penulis LIKE '%$search%'";

// (5.) Jalankan query (Hint : gunakan mysqli_query())
    $result = mysqli_query($conn, $query);


// (6.) Tampung hasil query ke dalam array (Hint : gunakan mysqli_fetch_assoc())
    while ($row = mysqli_fetch_assoc($result)) {
            $bukus[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h1>Katalog Buku</h1>
        <!-- (7.) Tambahkan Method  GET --> 
        <form action="katalog_buku.php"method="GET" class="form-inline">
            <!-- (8.)Tambahkan Value $search -->
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= htmlspecialchars($search) ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($bukus) == 0) : ?>
                    <tr>
                        <th colspan="5" class="text-center">TIDAK ADA DATA DALAM KATALOG</th>
                    </tr>
                <?php endif;?>
                <?php foreach ($bukus as $buku) : ?>
                    <tr>
                        <td><?= $buku['id']?></td>
                        <td><?= $buku['judul']?></td>
                        <td><?= $buku['penulis']?></td>
                        <td><?= $buku['tahun_terbit']?></td>
                        <td>
                            <a href="edit_buku.php?id=<?=$buku['id']?>" class="btn btn-primary">Edit</a>
                            <a href="delete.php?id=<?=$buku['id']?>" class="btn btn-danger" >Delete</a>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
