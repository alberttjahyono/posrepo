<?php
namespace POS\Controller\Transaksi;


use POS\Model\Entity\Transaksi as objekTransaksi;
use POS\Model\Entity\Barang as objekBarang;
use POS\Model\Entity\DetailTransaksi as objekDetailTransaksi;

use POS\Form\Transaksi as formTransaksi;
use POS\Form\Validator\TransaksiValidator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Session\Container;
class TransaksiController extends AbstractActionController {

	public function transaksiAction() {
		$transactionSession = new Container('transaksi');
		$namaUser = $this->AuthPlugin()->getLoginData();
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
		$request = $this -> getRequest();
		if ($request -> isPost()) {
			
			$myTransaction = $transactionSession->transaksi;		
			$total = 0;
				
			foreach($myTransaction as $allData){
				$total += $allData['Subtotal'];
			}
			$form = new formTransaksi();
			$formNama = $form -> get('namaBarang');
			$allId = $transactionSession->IdBarang;
			$allNama = $transactionSession->NamaBarang;
			$allOption = $transactionSession->OptionNama;
			$allHarga = $transactionSession->HargaBarang;
			$formNama -> setValueOptions($allOption);
    		$formValidator = new TransaksiValidator();
			{
				$form->setInputFilter($formValidator->getInputFilter());
				$form->setData($request->getPost());
			} 
			if(!$form->isValid()) 
	        {
	        	return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages());
	        }
			else{
				$bolean = false;
	        	for ($i=0; $i <count($myTransaction) ; $i++) { 
					if ($myTransaction[$i]['NamaBarang'] == $allNama[$request -> getPost('namaBarang')]){
						
						if($bolean==false){
							$myTransaction[$i]['StokBarang'] += $request -> getPost('stok');
							$myTransaction[$i]['Subtotal'] += $request -> getPost('stok') * $allHarga[$request -> getPost('namaBarang')];
							$bolean=true;
						}
					}
				}
			
				if ($bolean==false){
					array_push($myTransaction, array(
						'IdBarang' => $allId[$request -> getPost('namaBarang')],
						'NamaBarang' => $allNama[$request -> getPost('namaBarang')], 
						'StokBarang' => $request -> getPost('stok'), 
						'HargaBarang' => $allHarga[$request -> getPost('namaBarang')],
						'Subtotal'  => $request -> getPost('stok') * $allHarga[$request -> getPost('namaBarang')]
					));
				}
				
				$transactionSession->transaksi = $myTransaction;
								
				$total = 0;
				
				foreach($myTransaction as $allData){
					$total += $allData['Subtotal'];
				}
				$myTransaction = $transactionSession->myTransaction;
				return $this->redirect()->toRoute('transaksi', array(
				    'action' =>  'add'
				));
			}
		}
		else{
			$queryBuilder = $objectManager->createQueryBuilder()
				->select('u')
				->from('POS\Model\Entity\Barang' ,'u')
				->where('u.STATUS = :input')->setParameter('input', 'Launch')
				->orderBy('u.ID_BARANG', 'ASC');
			$query = $queryBuilder->getQuery();
			$selectOptions = $query->getResult();
			$form = new formTransaksi();
			$formNama = $form -> get('namaBarang');
			$allNama = array();
			$allNamaText = array();
			$allHarga = array();
			$allId = array();
			foreach ($selectOptions as $barang) {
				array_push($allId, $barang -> getIdBarang());
				array_push($allNama, $barang -> getNama() . ' - ' . $barang -> getHargaBeli() );
				array_push($allNamaText, $barang -> getNama());
				array_push($allHarga, $barang -> getHargaBeli() );
			}
			
			$transactionSession->OptionNama=$allNama;
			$transactionSession->NamaBarang=$allNamaText;
			$transactionSession->IdBarang=$allId;
			$transactionSession->HargaBarang=$allHarga;
			$transactionSession->transaksi=array();
			$myTransaction =$transactionSession->transaksi;
			$formNama -> setValueOptions($allNama);
			$total = 0;
			return array('form' => $form,'arrayData'=>$myTransaction,'totalAll'=>$total, 'messages' => $this -> flashmessenger() -> getMessages());
		}
		
	}

	public function addAction() {
		$transactionSession = new Container('transaksi');
		$namaUser = $this->AuthPlugin()->getLoginData();
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
		
		$form = new formTransaksi();
		$formNama = $form -> get('namaBarang');
		$allId = $transactionSession->IdBarang;
		$allNama = $transactionSession->NamaBarang;
		$allOption = $transactionSession->OptionNama;
		$allHarga = $transactionSession->HargaBarang;
		$formNama -> setValueOptions($allOption);
		
		$request = $this -> getRequest();
		$myTransaction = $transactionSession->transaksi;	
		$total = 0;
			
		foreach($myTransaction as $allData){
			$total += $allData['Subtotal'];
		}
		
		if ($request -> isPost()) {
			if($request->getPost("idDelete")==""){
        		$formValidator = new TransaksiValidator();
				{
					$form->setInputFilter($formValidator->getInputFilter());
					$form->setData($request->getPost());
				} 
				if(!$form->isValid()) 
		        {
		        	$transactionSession->transaksi=$myTransaction ;	
					return array('form' => $form,'arrayData'=>$myTransaction, 'totalAll'=>$total, 'messages' => $this -> flashmessenger() -> getMessages());	
		        }
				else{
					$bolean = false;
		        	for ($i=0; $i<count($myTransaction) ; $i++) { 
						if ($myTransaction[$i]['NamaBarang'] == $allNama[$request -> getPost('namaBarang')]){
							if($bolean==false){
								$myTransaction[$i]['StokBarang'] += $request -> getPost('stok');
								$myTransaction[$i]['Subtotal'] += $request -> getPost('stok') * $allHarga[$request -> getPost('namaBarang')];
								$bolean=true;
							}
						}
					}
				
					if ($bolean==false){
						array_push($myTransaction, array(
							'IdBarang' => $allId[$request -> getPost('namaBarang')],
							'NamaBarang' => $allNama[$request -> getPost('namaBarang')], 
							'StokBarang' => $request -> getPost('stok'), 
							'HargaBarang' => $allHarga[$request -> getPost('namaBarang')],
							'Subtotal'  => $request -> getPost('stok') * $allHarga[$request -> getPost('namaBarang')]
						));
					}
					$transactionSession->transaksi=$myTransaction ;	
					
					$total = 0;
					
					foreach($myTransaction as $allData){
						$total += $allData['Subtotal'];
					}
				}
        	}
			else{
				$myTransaction=$transactionSession->transaksi;	
				foreach($myTransaction as $subKey => $subArray){
			          if($subArray['IdBarang'] == $request->getPost("idDelete")){
			               unset($myTransaction[$subKey]);
			          }
			     }
				$total = 0;
				$newArrayTransaction = array_values($myTransaction);
				foreach($myTransaction as $allData){
					$total += $allData['Subtotal'];
				}
				$transactionSession->transaksi=$newArrayTransaction;
				if(count($myTransaction)==0){
					return $this->redirect()->toRoute('transaksi', array(
				    'action' =>  'transaksi',
					));
				}
				
			}
		}
		return array('form' => $form,'arrayData'=>$myTransaction, 'totalAll'=>$total, 'messages' => $this -> flashmessenger() -> getMessages());
	}

	public function beliAction() {
		$transactionSession = new Container('transaksi');
		$namaUser = $this->AuthPlugin()->getLoginData();
		$this->layout('layout/blank');	
		$redirect = 'beli';
		$myTransaction = $transactionSession->transaksi;
		$total = 0;
		foreach($myTransaction as $allData){
				$total += $allData['Subtotal'];
		}
		$transaksi = new objekTransaksi();
		$transaksi -> setUser($namaUser);
		$transaksi -> setTotal($total);
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
		
		$objectManager -> persist($transaksi);
		$objectManager -> flush();
		$transaksiID = $transaksi->getIdTransaksi();
		
		for ($i=0; $i <count($myTransaction) ; $i++) {
			
			$barang = new objekBarang();
			$barangRepository = $objectManager -> getRepository('POS\Model\Entity\Barang');
			$newBarang = $barangRepository -> findBy(array('ID_BARANG' => $myTransaction[$i]['IdBarang']));
			
			foreach ($newBarang as $item) {
				$barang -> setIdBarang($myTransaction[$i]['IdBarang']);
				$barang -> setNama($myTransaction[$i]['NamaBarang']);
				$barang -> setStok(($item->getStok() + $myTransaction[$i]['StokBarang']));
				$barang -> setHargaBeli($item->getHargaBeli());
				$barang -> setHargaJual($item->getHargaJual());
				$barang -> setStatus($item->getStatus());
				$objectManager -> merge($barang);
				$objectManager -> flush();
			}

			$Dtransaksi = new objekDetailTransaksi();
			$Dtransaksi -> setIdTransaksi($transaksiID);
			$Dtransaksi -> setIdBarang($myTransaction[$i]['IdBarang']);
			$Dtransaksi -> setJumlah($myTransaction[$i]['StokBarang']);
			$Dtransaksi -> setHarga($myTransaction[$i]['HargaBarang']);
			$objectManager -> persist($Dtransaksi);
			$objectManager -> flush();
			
			
		}
		$this -> flashmessenger() -> addMessage("Transaksi Berhasil");		
		return array('namaUser'=>$namaUser,'arrayData'=>$myTransaction, 'totalAll'=>$total, 'messages' => $this -> flashmessenger() -> getMessages());
	}

}
?>