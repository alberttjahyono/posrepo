<?php
namespace POS\Controller\Transaksi;

use POS\Model\Entity\Barang;
use POS\Model\Entity\Transaksi;
use POS\Model\Entity\DetailTransaksi;

use POS\Form\InsertBarang;
use POS\Form\Validator\InsertValidator; 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class InsertController extends AbstractActionController {
	public function insertAction() {
		$namaUser = $this->AuthPlugin()->getLoginData();
		$form = new InsertBarang();
		
		$redirect = 'home';
		$request = $this -> getRequest();
		if ($request -> isPost()) {
			$formValidator = new InsertValidator();
			{
				$form->setInputFilter($formValidator->getInputFilter());
				$form->setData($request->getPost());
			} 
			if(!$form->isValid()) 
	        { 
				return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages());
	        } 
			else{
				$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
				$barang = new Barang();
				$barang -> setNama($request -> getPost('nama'));
				$barang -> setStok($request -> getPost('stok'));
				$barang -> setHargaBeli($request -> getPost('hargaBeli'));
				$barang -> setHargaJual($request -> getPost('hargaBeli') + 500);
				$barang -> setStatus('Launch');
				$objectManager -> persist($barang);
				$objectManager -> flush();
				$barangID = $barang->getIdBarang();
				
				
				$total = $request -> getPost('stok') * $request -> getPost('hargaBeli');
				
				$transaksi = new Transaksi();
				$transaksi -> setUser($namaUser);
				$transaksi -> setTotal($total);
				$objectManager -> persist($transaksi);
				$objectManager -> flush();
				$transaksiID = $transaksi->getIdTransaksi();
				
				$Dtransaksi = new DetailTransaksi();
				$Dtransaksi -> setIdTransaksi($transaksiID);
				$Dtransaksi -> setIdBarang($barangID);
				$Dtransaksi -> setJumlah($request -> getPost('stok'));
				$Dtransaksi -> setHarga($request -> getPost('hargaBeli'));
				$objectManager -> persist($Dtransaksi);
				$objectManager -> flush();
				
				$this -> flashmessenger() -> addMessage("Barang sukses dibeli");
				return $this->redirect()->toRoute($redirect);
			}
		}
		else{
			return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages());
		}
	}
}
?>