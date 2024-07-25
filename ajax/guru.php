<?php 

require '../functions.php';
$keyword = $_GET["keyword"]; 
$query = "SELECT * FROM guru
				WHERE
			  nama LIKE '%$keyword%' OR
			  nrp LIKE '%$keyword%' OR
			  alamat LIKE '%$keyword%' OR
			  hp LIKE '%$keyword%'
			";
$guru = query($query);
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
<?php foreach( $guru as $row ) : ?>
<tr>
	<td><?= $i; ?></td>
	<td>
		<a href="ubah-guru.php?id=<?= $row["id"]; ?>">Ubah</a> |
		<a href="hapus-guru.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah anda yakin untuk menghapus?');">Hapus</a>
	</td>
	<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
	<td><?= $row["nrp"]; ?></td>
	<td><?= $row["nama"]; ?></td>
	<td><?= $row["alamat"]; ?></td>
	<td><?= $row["hp"]; ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>

</table>