<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$buku = query("SELECT * FROM buku LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$buku = cariBuku($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Admin</title>
	
	<style>
		/* Google Fonts Import Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
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
.navbar{
    padding: 0;
  display: flex;
  align-items: center;
  background: #fff;
  padding: 20px 15px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.2);
}

.navbar h1{
  margin-left: 100px;
}

.navbar span{
  font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  color: blue;
}

.navbar .navbar-item a{
  margin-left: 30px;
  position: relative;
  color: #333;
  font-size: 20px;
  font-weight: 500;
  text-decoration: none;
}

.navbar .navbar-item a:before{
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
.navbar .navbar-item a:hover:before{
  width: 100%;
}

.form-cari {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


#keyword {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 300px;
}

.insert-search{
    margin-top: 20px;
    margin-bottom: 20px;
  justify-content: space-around;
  display: flex;

}

.insert-search .form-cari{
  
  display: flex;
  justify-content: center;
  align-items: center;
}

.container{
  display: flex;
  justify-content: center;
  align-items: center;
}

.container table a{
  text-decoration: none;
  color: black;
}

 .insert-search .tambah-item {
  display: flex;
  align-items: center;
  justify-content: center;
}

.insert-search .tambah-item .btn-add-siswa {
  padding: 10px 20px;
  background: darkblue;
  border-radius: 10px;
}

.insert-search .tambah-item .btn-add-siswa a{
  color: white;
  font-size: 15px;
  font-family: Georgia, 'Times New Roman', Times, serif;
}

a {
  list-style: none;
  text-decoration: none;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style-type: none;
    padding: 0;
    margin-top: 50px;
}

.pagination a {
    color: black;
    padding: 8px 12px;
    text-decoration: none;
    transition: background-color 0.3s;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 4px;
}

.pagination a:hover {
    background-color: #ddd;
}

.pagination a.active {
    font-weight: bold;
    color: white;
    background-color: #4CAF50;
}

.pagination a:first-child, .pagination a:last-child {
    font-weight: bold;
}

.pagination a.prev, .pagination a.next {
    font-weight: bold;
}
.card-wrapper {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    align-items: center;
}
.card {
    display: flex; /* Mengatur card untuk tampil sebagai flex container */
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 600px; /* Lebar maksimum card */
    margin: 20px;
    overflow: hidden;
    transition: transform 0.1s;
}

.card:hover {
    transform: scale(1.05);
}

.card-img {
    width: 40%; /* Lebar gambar */
    height: auto;
    object-fit: cover; /* Memastikan gambar tetap proporsional */
}

.card-content {
    padding: 20px;
    width: 60%; /* Lebar konten teks */
    display: flex;
    flex-direction: column;
}

.card-title {
    font-size: 1.8em; /* Ukuran font judul */
    font-weight: 600; /* Menebalkan judul */
    margin: 0;
    color: #333; /* Warna judul */
}

.card-description {
    font-size: 1.1em; /* Ukuran font deskripsi */
    color: #666;
    margin: 10px 0;
    line-height: 1.6; /* Jarak antar baris deskripsi */
}

.card-date {
    font-size: 0.9em; /* Ukuran font tanggal */
    color: #999; /* Warna tanggal */
    margin-bottom: 10px;
}

.card-button {
    display: inline-block;
    padding: 8px 16px; /* Mengurangi ukuran tombol */
    margin-top: 100px;
    background-color: #007BFF;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
    font-size: 0.9em; /* Ukuran font tombol */
}

.card-button:hover {
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


	<!-- navigasi -->
	<!-- <div class="pagination">
    <a href="?halaman=1">awal</a>
    
    <?php if( $halamanAktif > 1 ) : ?>
        <a href="?halaman=<?= $halamanAktif - 1; ?>" class="prev">&laquo;</a>
    <?php endif; ?>
    
    <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
        <?php if( $i == $halamanAktif ) : ?>
            <a href="?halaman=<?= $i; ?>" class="active"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    
    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
        <a href="?halaman=<?= $halamanAktif + 1; ?>" class="next">&raquo;</a>
    <?php endif; ?>
    
    <a href="?halaman=<?= $jumlahHalaman; ?>">akhir</a>
</div> -->

<?php $i = 1; ?>
<div class="card-wrapper">
<?php foreach( $buku as $row ) : ?>
    <div class="card">
        <img src="img/<?= $row["gambar"]; ?>" alt="Image" class="card-img">
        <div class="card-content">
            <h2 class="card-title"><?= $row["judul"]; ?></h2>
            <p class="card-description"><?= $row["deskripsi"]; ?></p>
            <p class="card-date">Tanggal Terbit : <?= $row["tanggal_terbit"]; ?></p>
            <p class="card-date">Penerbit : <?= $row["penerbit"]; ?></p>
            
            <a href="detail-buku.php?id=<?= $row["id"]; ?>" class="card-button">Pinjam Buku</a>
        </div>
    </div>
<?php $i++; ?>
<?php endforeach; ?>
</div>


<script src="js/script.js"></script>

</body>
</html>
