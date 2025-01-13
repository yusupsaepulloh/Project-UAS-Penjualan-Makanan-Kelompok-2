<?php 
	error_reporting(0);
	session_start();
	include 'db.php';
	if ($_SESSION['status_login'] != true) {
		header("Location: loginUser.php");
		exit;
	}

	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
	$a = mysqli_fetch_object($kontak);

	// Ambil data pengguna dari database
	$user_id = $_SESSION['id'];
	$user = mysqli_query($conn, "SELECT * FROM user WHERE id = '$user_id'");
	if ($user) {
		$b = mysqli_fetch_object($user);
		echo "Selamat datang, " . $b->Nama; // Ganti 'nama' dengan nama kolom yang sesuai
	} else {
		echo "Data pengguna tidak ditemukan!";
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
			<a href="index2.php" class="active">Home</a>
			<a href="produk2.php">Produk</a>
			<a href="about2.php">About</a>
		</div>

		<a href="keluarUser.php" onclick="return confirmLogout()" target="_blank"><div class="header-right"><button>LogOut</button></div></a>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk2.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- new product -->
	<div class="section">
		<div class="container">
			<h3>Produk</h3>
			<div class="box">
				<?php 
					if($_GET['search'] != '' || $_GET['kat'] != ''){
						$where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
					}

					$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
					if(mysqli_num_rows($produk) > 0){
						while($p = mysqli_fetch_array($produk)){
				?>
					<a href="detail-produk2.php?id=<?php echo $p['product_id'] ?>">
						<div class="col-4">
							<img src="produk/<?php echo $p['product_image'] ?>">
							<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
							<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Produk tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
		</div>
	</div>

	<script>
		function confirmLogout() {
			return confirm("Apakah Anda yakin ingin logout?");
		}
	</script>
</body>
</html>