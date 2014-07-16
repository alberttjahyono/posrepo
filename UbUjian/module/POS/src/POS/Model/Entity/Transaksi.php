<?php
namespace POS\Model\Entity;

class Transaksi {
	
    protected $ID_TRANSAKSI;	
    protected $USER;	
	protected $TANGGAL;
	protected $TOTAL;	
	
    public function getIdTransaksi() {
        return $this->ID_TRANSAKSI;
    }
	public function setIdTransaksi($ID_TRANSAKSI) {
        $this->ID_TRANSAKSI = $ID_TRANSAKSI;
        return $this;
    }
	
    public function getUser() {
        return $this->USER;
    }
	public function setUser($USER) {
        $this->USER = $USER;
        return $this;
    }
	public function getTanggal() {
        return $this->TANGGAL;
    }
	public function setTanggal($TANGGAL) {
        $this->TANGGAL = $TANGGAL;
        return $this;
    }
	public function getTotal() {
        return $this->TOTAL;
    }
	public function setTotal($TOTAL) {
        $this->TOTAL = $TOTAL;
        return $this;
    }
}