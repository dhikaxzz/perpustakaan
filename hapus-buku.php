<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$id = $_GET["id"];

if( hapusBuku($id) > 0 ) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'buku.php';
		</script>
	";
} else {
	echo "
		<script>
			alert('Data gagal ditambahkan!');
			document.location.href = 'buku.php';
		</script>
	";
}

?>