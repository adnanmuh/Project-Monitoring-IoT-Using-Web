<?php
//Variabel database
    $servername = "localhost";
    $username = "id15443097_adnanmuh";
    $password = "U\UDLH9gh3q**l}{";
    $dbname   = "id15443097_justdatabase";
    $koneksi = mysqli_connect($servername, $username, $password, $dbname); // menggunakan mysqli_connect
    
 
	if(mysqli_connect_errno()){ // mengecek apakah koneksi database error
		echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error(); // pesan ketika koneksi database error
	}
?>