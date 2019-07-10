<?php  
function seo_title($s) {
	$c = array (' ');
	$d = array ('-','/',',',':',';','?','\'','"','\\',']','[','|','}','{','=','-','+','_',')','(','*','&','^','%','$','#','@','!','`','~','<','>');

	$s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
	$s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan karakter "-" dan ubah hurufnya menjadi huruf kecil semua
	return $s;
}
?>