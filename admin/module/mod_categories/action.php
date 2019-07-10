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

	if ($module=='categories' AND $act=='input'){
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$kategori_seo = seo_title($_POST['name']);

		mysqli_query($con,"INSERT INTO categories (title, seotitle) VALUES('$name','$kategori_seo')");

		header('location:../../media.php?module=categories');
	}

	// Update Kategori

	elseif ($module=='categories' AND $act=='update'){
		$name = mysqli_real_escape_string($con, $_POST['name']);
		$active = $_POST['active'];
		$kategori_seo = seo_title($_POST['name']);
		$id = $_POST['id'];

		mysqli_query($con, "UPDATE categories SET title='$name', seotitle='$kategori_seo' , active='$active' WHERE id = '$id'");

		header('location:../../media.php?module=categories');
}
}


?>