<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>WarungModern</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
	<!-- header -->
	<header>
	<div class="page-header">
		<div class="logo">
			<p>Warung Modern</p>
		</div>
		<a id="menu-icon" class="menu-icon" onclick="onMenuClick()">
			<i class="fa fa-bars"></i>
		</a>

		<div id="navigation-bar" class="nav-bar">
			<a href="dashboard.php" class="active">Dashboard</a>
			<a href="profil.php">Profil</a>
			<a href="data-kategori.php">Data Kategori</a>
			<a href="data-produk.php">Data Produk</a>
		</div>

		<a href="keluar.php" onclick="return confirmLogout()" target="_blank"><div class="header-right"><button>LogOut</button></div></a>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Data Kategori</h3>
			<div class="box">
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Kategori</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
							if(mysqli_num_rows($kategori) > 0){
							while($row = mysqli_fetch_array($kategori)){
						?>
						<tr>
							<td><?php echo $no++ ?></td>
							<td><?php echo $row['category_name'] ?></td>
							<td>
								<button><a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a></button> || <button style="background-color:red;"><a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a><button>
							</td>
						</tr>
						<?php }}else{ ?>
							<tr>
								<td colspan="3">Tidak ada data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<br>
				<button><a href="tambah-kategori.php">Tambah Kategori</a></button>
			</div>
		</div>
	</div>

</body>
</html>