<?php
	$koneksi = mysqli_connect("localhost","root","","spp_management");
	if(!$koneksi){
		echo "<h1 align='center'>Database tidak terhubung!</h1>";	
		exit();
	}


?>