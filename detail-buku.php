<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$buku = query("SELECT * FROM buku WHERE id = $id")[0];

// // cek apakah tombol submit sudah ditekan atau belum
// if( isset($_POST["submit"]) ) {
	
// 	// cek apakah data berhasil diubah atau tidak
// 	if( ubah($_POST) > 0 ) {
// 		echo "
// 			<script>
// 				alert('Data berhasil diubah!');
// 				document.location.href = 'index.php';
// 			</script>
// 		";
// 	} else {
// 		echo "
// 			<script>
// 				alert('Data gagal diubah!');
// 				document.location.href = 'index.php';
// 			</script>
// 		";
// 	}


// }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Ubah data mahasiswa</title>
	<style>
/* Mengimpor font dari Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
  height: 100vh;
  align-items: center;
  justify-content: center;
  background: #c1f7f5;
}

.navbar {
    display: flex;
    align-items: center;
    background: #fff;
    padding: 20px 15px;
    border-radius: 12px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    margin-bottom: 20px;
}

.navbar h1 {
    margin-left: 100px;
}

.navbar span {
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    color: blue;
}

.navbar .navbar-item a {
    margin-left: 30px;
    position: relative;
    color: #333;
    font-size: 20px;
    font-weight: 500;
    text-decoration: none;
}

.navbar .navbar-item a:before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 0%;
    background: #34efdf;
    border-radius: 12px;
    transition: all 0.4s ease;
}

.navbar .navbar-item a:hover:before {
    width: 100%;
}

.detail-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.card-wrapper {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 20px;
}

.card {
    display: flex;
    flex-direction: row; /* Menampilkan gambar dan konten berdampingan */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 800px; /* Menentukan lebar maksimum card */
    width: 100%; /* Menyesuaikan lebar card dengan kontainer */
}



.card-img {
    width: 40%; /* Menentukan lebar gambar */
    height: auto;
    object-fit: cover; /* Memastikan gambar proporsional */
}

.card-content {
    padding: 20px;
    width: 60%; /* Menentukan lebar konten teks */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Menyelaraskan konten di tengah */
}

.card-title {
    font-size: 2em; /* Ukuran font judul */
    font-weight: 600;
    color: #333; /* Warna judul */
    margin: 0 0 10px;
}

.card-description {
    font-size: 1.1em; /* Ukuran font deskripsi */
    margin-bottom: 10px;
    line-height: 1.6; /* Jarak antar baris deskripsi */
}

.card-date {
    margin-bottom: 10px;
}

.borrow-button {
    display: inline-block;
    padding: 8px 16px;
    background-color: #28a745; /* Warna hijau untuk tombol pinjam */
    color: #fff;
    width: 100%;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-size: 0.9em;
    margin-top: 10px;
    margin-right: 10px; /* Spasi antara tombol pinjam dan kembali */
}

.borrow-button:hover {
    background-color: #218838; /* Warna hijau gelap saat hover */
}

.back-button {
    display: inline-block;
    padding: 8px 16px;
    width: 100% ;
    background-color: #007BFF;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-size: 0.9em;
    margin-top: 10px;
}

.back-button:hover {
    background-color: #0056b3;
}

	</style>
</head>
<body>

	<div class="navbar">
	<div class="navbar-title">
		<h1>Daftar <span>Sekolah</span></h1>
	</div>
	<div class="navbar-item">
		<a href="index.php">Daftar Siswa</a>
		<a href="guru.php">Daftar Guru</a>
		<a href="buku.php">Daftar Buku</a>
		<a href="logout.php">Logout</a>
	</div>
</div>

<div class="detail-container">
    <div class="card-wrapper">
        <div class="card">
            <img src="img/<?= $buku["gambar"]; ?>" alt="<?= $buku["judul"]; ?>" class="card-img">
            <div class="card-content">
                <h2 class="card-title"><?= $buku["judul"]; ?></h2>
                <p class="card-description"><?= $buku["deskripsi"]; ?></p>
                
                <form action="/action_page.php">
                <p class="card-date">Tanggal Terbit : <?= $buku["tanggal_terbit"]; ?></p>
                <p class="card-date">Tanggal Terbit : <?= $buku["penerbit"]; ?></p>
                  <label for="birthday">Masa Pinjam :</label>
                  <input type="number" id="birthday" name="birthday">
                  <button type="submit" name="submit">Pinjam Buku</button>
                </form>
                <a href="pinjam-buku.php?id=<?= $buku["id"]; ?>" class="borrow-button">Pinjam Buku</a>
                <a href="buku.php" class="back-button">Kembali ke Daftar Buku</a>
            </div>
        </div>
    </div>
</div>






</body>
</html>