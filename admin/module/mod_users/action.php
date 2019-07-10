<?php 
session_start();

if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
  echo "<h2>Untuk mengakses modul, and harus login terlebih dahulu.</h2>
  <p><a href='index.php'>LOGIN</a></p>";
}
else {
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";

	$module=$_GET['module'];
	$act=$_GET['act'];

	// Input Kategori

	if ($module=='users' AND $act=='input'){
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$user_seo = seo_title($_POST['name']);

		mysqli_query($con,"INSERT INTO users (title, seotitle) VALUES('$name','$user_seo')");

		header('location:../../media.php?module=users');
	}

	// Update Kategori

	elseif ($module=='users' AND $act=='update'){
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$active = $_POST['active'];
		$user_seo = seo_title($_POST['name']);
		$id = $_POST['id'];

		mysqli_query($con, "UPDATE users SET title='$name', seotitle='$user_seo' , active='$active' WHERE id = '$id'");

		header('location:../../media.php?module=users');
}
}


?>