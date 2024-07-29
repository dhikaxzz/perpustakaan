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
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// tombol cari ditekan
if( isset($_POST["cari"]) ) {
	$mahasiswa = cari($_POST["keyword"]);
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
	
	<div class="pagination">
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
</div>

<div class="insert-search">

		<div class="tambah-item">
			<button class="btn-add-siswa">
				<a href="tambah.php">Tambah Data Mahasiswa</a>
			</button>
		</div>

	<form action="" method="post" class="form-cari">
		<input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian.." autocomplete="off" id="keyword">		

	</form>

</div>

<div class="container" id="container">

<table border="1" cellpadding="10" cellspacing="0">

<tr>
	<th>No.</th>
	<th class="aksi">Aksi</th>
	<th>Gambar</th>
	<th>NRP</th>
	<th>Nama</th>
	<th>Email</th>
	<th>Jurusan</th>
</tr>

<?php $i = 1; ?>
<?php foreach( $mahasiswa as $row ) : ?>
<tr>
	<td><?= $i; ?></td>
	<td>
		<a href="ubah.php?id=<?= $row["id"]; ?>">Ubah</a> |
		<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin untuk menghapus?');">Hapus</a>
	</td>
	<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
	<td><?= $row["nrp"]; ?></td>
	<td><?= $row["nama"]; ?></td>
	<td><?= $row["email"]; ?></td>
	<td><?= $row["jurusan"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>

</div>


<script src="js/script.js"></script>

</body>
</html>