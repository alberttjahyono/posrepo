<?php
namespace POS\Controller\Edit;

use POS\Model\Entity\Barang;

use POS\Form\UpdateBarang;
use POS\Form\Validator\UpdateValidator; 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EditController extends AbstractActionController {

	public function editAction() {
		$namaUser = $this->AuthPlugin()->getLoginData();
		$form = new UpdateBarang();
		
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
		$barang = new Barang();
		$request = $this -> getRequest();
		
		if ((!$this -> params('id') != 0)) {
			return $this -> redirect() -> toRoute('home');	
		} else {
			$myId = $this -> params('id');
			
			if ($request -> isPost()) {
				$formValidator = new UpdateValidator();
				{
					$form->setInputFilter($formValidator->getInputFilter());
					$form->setData($request->getPost());
				} 
				if(!$form->isValid()) 
		        {
		        	return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages(), 'myId' => $myId);	
		        }
				else
				{
					$barang -> setIdBarang($myId);
					$barang -> setNama($request -> getPost('nama'));
					$barang -> setStok($request -> getPost('stok'));
					$barang -> setHargaBeli($request -> getPost('hargaBeli'));
					$barang -> setHargaJual($request -> getPost('hargaJual'));
					$barang -> setStatus($request -> getPost('status'));
					$objectManager -> merge($barang);
					$objectManager -> flush();
					$this -> flashmessenger() -> addMessage("Barang sukses terupdate");
					return $this -> redirect() -> toRoute('home');
				}	
			}else{
				$barangRepository = $objectManager -> getRepository('POS\Model\Entity\Barang');
				$barangData = $barangRepository -> findBy(array('ID_BARANG' => $myId));
				foreach ($barangData as $item) {
					$formNama = $form -> get('nama');
					$formNama -> setValue($item->getNama());
					$formStok = $form -> get('stok');
					$formStok -> setValue($item->getStok());
					$formHargaBeli = $form -> get('hargaBeli');
					$formHargaBeli -> setValue($item->getHargaBeli());
					$formHargaJual = $form -> get('hargaJual');
					$formHargaJual -> setValue($item->getHargaJual());
					$formStatus = $form -> get('status');
					$formStatus -> setValue($item->getStatus());					
				}
				return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages(), 'myId' => $myId);
			}
		}
	}
}
?>