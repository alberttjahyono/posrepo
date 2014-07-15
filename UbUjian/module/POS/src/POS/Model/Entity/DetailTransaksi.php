<?php
namespace POS\Model\Entity;

class DetailTransaksi {
	protected $ID_DETAIL;
	protected $ID_TRANSAKSI;	
    protected $ID_BARANG;	
	protected $JUMLAH;
	protected $HARGA;	
	
	public function getIdDetail() {
        return $this->ID_DETAIL;
    }
	public function setIdDetail($ID_DETAIL) {
        $this->ID_DETAIL = $ID_DETAIL;
        return $this;
    }
	public function getIdTransaksi() {
        return $this->ID_TRANSAKSI;
    }
	public function setIdTransaksi($ID_TRANSAKSI) {
        $this->ID_TRANSAKSI = $ID_TRANSAKSI;
        return $this;
    }
	
    public function getIdBarang() {
        return $this->ID_BARANG;
    }
	public function setIdBarang($ID_BARANG) {
        $this->ID_BARANG = $ID_BARANG;
        return $this;
    }
    public function getJumlah() {
        return $this->JUMLAH;
    }
	public function setJumlah($JUMLAH) {
        $this->JUMLAH = $JUMLAH;
        return $this;
    }
	public function getHarga() {
        return $this->HARGA;
    }
	public function setHarga($HARGA) {
        $this->HARGA = $HARGA;
        return $this;
    }
	
 
}