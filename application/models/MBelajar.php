<?php

Class MBelajar extends CI_Model {

	public function getProduk() {
		return "SIKABER";
	}

	public function ambil($nama) {
		return "Nama Produk : ".$nama;
	}

}

?>