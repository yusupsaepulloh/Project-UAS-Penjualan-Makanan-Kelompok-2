<?php
session_start();
$_SESSION['pesan'] = "Anda telah berhasil logout.";
session_unset();
session_destroy();
header("Location: loginUser.php");
exit;
?>
