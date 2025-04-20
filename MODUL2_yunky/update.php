<!-- BUAT FUNGSI EDIT DATA ( ketika data berhasil di tambahkan maka akan dialihkan ke halaman katalog buku) -->
<?php
include 'connect.php';
if(isset($_POST["update"])) {
    $id = isset($_POST["id"]) ? intval($_POST["id"]) : 0;
    $judul_buku = $_POST["judul"];
    $penulis_buku = $_POST["penulis"];  
    $tahun_terbit = $_POST["tahun_terbit"];

    $query = "UPDATE tb_buku SET
            judul='$judul_buku',
            penulis='$penulis_buku',
            tahun_terbit='$tahun_terbit'
            WHERE id=$id";
    
    $test = mysqli_query($conn, $query);
    if (mysqli_affected_rows($conn) > 0) {
        header("location: katalog_buku.php");
    } else {
        echo "<script>alert('Data gagal diupdate');</script>";
    }
}
?>