<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambahGuru($_POST) > 0 ) {
		echo "
			<script>
				alert('Data berhasil ditambahkan!');
				document.location.href = 'guru.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'guru.php';
			</script>
		";
	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah data guru</title>
	<style>
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

  .title h1{
    display: flex;
    align-items: center;
    margin-top: 50px;
    justify-content: center;
    color: black;
  }

  form {
    max-width: 600px;
    margin: auto;
    margin-top: 40px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 20px;
    background-color: #f9f9f9;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
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

	<div class="title">
		<h1>Tambah Data Guru</h1>
	</div>

	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nrp">NRP : </label>
				<input type="text" name="nrp" id="nrp" required>
			</li>
			<li>
				<label for="nama">Nama : </label>
				<input type="text" name="nama" id="nama">
			</li>
			<li>
				<label for="alamat">Alamat :</label>
				<input type="text" name="alamat" id="alamat">
			</li>
			<li>
				<label for="hp">No HP :</label>
				<input type="text" name="hp" id="hp">
			</li>
			<li>
				<label for="gambar">Gambar :</label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data!</button>
			</li>
		</ul>

	</form>




</body>
</html>