<?php 

// Apabila user belum login
	if (empty($_SESSION['username']) AND empty($_SESSION['password'])){
	echo "<h1>Untuk mengakses modul, and harus login terlebih dahulu.</h1>
	<p><a href='index.php'>LOGIN</a></p>";
}
// Apabila user sudah login dengan benar, maka terbentuklah session

else{
	include ('../config/koneksi.php');

	// Module Home
	if ($_GET['module']=='home'){
		if ($_SESSION['level']=='admin' OR $_SESSION['level']=='user'){
			include ('module/mod_home/home.php');
		}
	}

	// Module Categories
	elseif ($_GET['module']=='categories'){
		if($_SESSION['level']=='admin'){
			include ('module/mod_categories/categories.php');
		}
	}

	// Module Tags
	elseif ($_GET['module']=='tags'){
		if($_SESSION['level']=='admin'){
			include ('module/mod_tags/tags.php');
		}
	}

	// Module Users
	elseif ($_GET['module']=='users'){
		if($_SESSION['level']=='admin'){
			include ('module/mod_users/users.php');
		}
	}

}

?>