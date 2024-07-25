<?php 

require '../functions.php';
$keyword = $_GET["keyword"]; 
$query = "SELECT * FROM buku
				WHERE
			  judul LIKE '%$keyword%' OR
			  penerbit LIKE '%$keyword%' OR
			  tahun LIKE '%$keyword%' OR
			  jumlah LIKE '%$keyword%'
			";
$buku = query($query);
?>

<table border="1" cellpadding="10" cellspacing="0">

<tr>
	<th>No.</th>
	<th class="aksi">Aksi</th>
	<th>Gambar</th>
	<th>NRP</th>
	<th>Nama</th>
	<th>Alamat</th>
	<th>HP</th>
</tr>

<?php $i = 1; ?>
<?php foreach( $buku as $row ) : ?>
<tr>
	<td><?= $i; ?></td>
	<td>
		<a href="ubah-buku.php?id=<?= $row["id"]; ?>">Ubah</a> |
		<a href="hapus-buku.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin untuk menghapus?');">Hapus</a>
	</td>
	<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
	<td><?= $row["judul"]; ?></td>
	<td><?= $row["penerbit"]; ?></td>
	<td><?= $row["tahun"]; ?></td>
	<td><?= $row["jumlah"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>