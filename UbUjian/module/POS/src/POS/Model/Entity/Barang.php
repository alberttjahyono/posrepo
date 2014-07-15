<?php
namespace POS\Model\Entity;

class Barang {
	
    protected $ID_BARANG;	
    protected $NAMA;	
	protected $STOK;
	protected $HARGA_BELI;	
	protected $HARGA_JUAL;
	protected $STATUS;
	
    public function getIdBarang() {
        return $this->ID_BARANG;
    }
	public function setIdBarang($ID_BARANG) {
        $this->ID_BARANG = $ID_BARANG;
        return $this;
    }
	
    public function getNama() {
        return $this->NAMA;
    }
	public function setNama($NAMA) {
        $this->NAMA = $NAMA;
        return $this;
    }
	public function getStok() {
        return $this->STOK;
    }
	public function setStok($STOK) {
        $this->STOK = $STOK;
        return $this;
    }
	public function getHargaBeli() {
        return $this->HARGA_BELI;
    }
	public function setHargaBeli($HARGA_BELI) {
        $this->HARGA_BELI = $HARGA_BELI;
        return $this;
    }
	public function getHargaJual() {
        return $this->HARGA_JUAL;
    }
	public function setHargaJual($HARGA_JUAL) {
        $this->HARGA_JUAL = $HARGA_JUAL;
        return $this;
    }
	
	public function getStatus() {
        return $this->STATUS;
    }
	public function setStatus($STATUS) {
        $this->STATUS = $STATUS;
        return $this;
    }
 
}