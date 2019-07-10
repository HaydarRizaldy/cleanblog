<?php 
include ('../config/koneksi.php');

// fungsi untuk menghindari injeksi dari user yang jahil
function anti_injection($data){
	$filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
	return $filter;
}

// $salt = '$%DSuTyr47542@#&*!=QxR094(a911)+';
// $username = anti_injection($_POST['username']);
// $password = anti_injection(hash('sha256', $salt, $_POST['password']));

$username = anti_injection($_POST['username']);
$password = anti_injection(md5($_POST['password']));

// menghindari sql injection
$injeksi_username = mysqli_real_escape_string($con, $username);
$injeksi_password = mysqli_real_escape_string($con, $password);

// pastikan username dan password adalah berupa huruf atau angka
if (!ctype_alnum($injeksi_username) OR !ctype_alnum($injeksi_password)){
	echo "<h1>Anda melakukan injeksi pada form login</h1>
		  <p><a href='index.php'>LOGIN KEMBALI</a></p>"; 
}
else{
	$query  = "SELECT * FROM users WHERE username='$injeksi_username' AND password='$injeksi_password' AND blokir='N'";
	$login  = mysqli_query($con, $query);
	$ketemu = mysqli_num_rows($login);
	$r 		= mysqli_fetch_assoc($login);

	// Apabila username dan password ditemukan (benar)
	if ($ketemu > 0){
		session_start();
	// include "timeout.php"

	// $_SESSION['KCFINDER']=array();
	// $_SESSION['KCFINDER']{'disabled'] = false;
	// $_SESSION['KCFINDER']['uploadURL'] = "../tinymce/gambar";
	// $_SESSION['KCFINDER']['uploadDir'] = "";

	$_SESSION['username'] 		= $r['username'];
	$_SESSION['nama_lengkap']	= $r['nama_lengkap'];
	$_SESSION['password']		= $r['password'];
	$_SESSION['level']			= $r['level'];

	// session timeout
	// $_SESSION[login] = 1;
	// timer(;

		// buat id_session yang unik dan menguploadnya agar selalu berubah
		// agar yser biasa sulit untuk mengganti password Administrator
		$sid_lama = session_id();
		session_regenerate_id();
		$sid_baru = session_id();
		mysqli_query($konek, "UPDATE users SET id_session='$sid_baru' WHERE username= '$username'");

		header('location:media.php?module=home');
	}
	else{
		echo "<h1>Login Gagal, Username & Password Salah.</h1>";
		echo "<p><a href='index.php'>Ulangi Lagi</a></p>";
	}
}
?>
