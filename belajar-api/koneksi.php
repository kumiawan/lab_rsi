<?php

$koneksi = mysqli_connect("localhost", "root", "", "informatika");
if (!$koneksi) {

	die("error status:" . mysqli_connect_error());
} else {
	return $koneksi;
}
