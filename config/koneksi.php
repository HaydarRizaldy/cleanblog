<?php
	date_default_timezone_set('Asia/Jakarta');

	$con = mysqli_connect("localhost","root","AldyCool9810852","cleanblog");

	if (mysqli_connect_errno())
	{
		echo('Error Koneksi Database : ' . mysqli_connect_error());
	}
?>