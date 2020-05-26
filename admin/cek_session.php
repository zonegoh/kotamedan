<?php 
session_start();
$cek = $_SESSION['token_expired'];
$nama = $_SESSION['nama'];
$pp = $_SESSION['pp'];
$idx_user = $_SESSION['idx_user'];
$isAdmin = $_SESSION['isAdmin'];
$tgl = date('Y-m-d H:i:s');

if (!$nama) {
	session_unset();
	session_destroy();
	header('Location: index.php');
} else {
	if ( $tgl > $cek ) {
		session_unset();
		session_destroy();
		header('Location: index.php');
	}
}
?>