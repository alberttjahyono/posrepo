<?php
namespace POS\Controller\Delete;

use POS\Model\Entity\Barang;

use POS\Form\UpdateBarang;
use POS\Form\Validator\UpdateValidator; 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class DeleteController extends AbstractActionController {

	public function deleteAction() {
		$namaUser = $this->AuthPlugin()->getLoginData();
		
		if (($this -> params('id') != 0)) {
			$myId = $this -> params('id');
			$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
			$barang = new Barang();
			$barangRepository = $objectManager -> getRepository('POS\Model\Entity\Barang');
			$barangData = $barangRepository -> findBy(array('ID_BARANG' => $myId));
			
			foreach ($barangData as $item) {			
				$barang -> setIdBarang($myId);
				$barang -> setNama($item->getNama());
				$barang -> setStok($item->getStok());
				$barang -> setHargaBeli($item->getHargaBeli());
				$barang -> setHargaJual($item->getHargaJual());
				if($item->getStatus()=="Launch"){
					$barang -> setStatus('Standby');
				}
				else{
					$barang -> setStatus('Launch');
				}
				$objectManager -> merge($barang);
				$objectManager -> flush();		
			}
		}
		return $this -> redirect() -> toRoute('home');

	}

}
?>