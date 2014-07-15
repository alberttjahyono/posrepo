<?php
namespace POS\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class UpdateValidator implements InputFilterAwareInterface {
	protected $inputFilter;

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception("Not used");
	}

	public function getInputFilter() {
		if (!$this -> inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter -> add($factory -> createInput(
			array(
				'name' => 'nama', 
				'required' => 'true', 
				'validators' => array(
					array(
		                    'name'=>'NotEmpty',
		                    'options'=>array(
		                        'messages' => array('isEmpty' => 'Nama Barang harus diisi !')
		                    ),
		                    'breakChainOnFailure'=>true
		            ),
				), 
			)));
			$inputFilter -> add($factory -> createInput(
			array(
				'name' => 'hargaBeli', 
				'required' => 'true', 
				'validators' => array( 
					array(
						'name' => 'NotEmpty', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('isEmpty' => 'Harga Beli tidak boleh kosong')
						),  
					),  
					array(
						'name' => 'Digits', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('notDigits' => 'Harga Beli harus bertipe integer')
						),  
					),
					
				), 
			)));
			$inputFilter -> add($factory -> createInput(
			array(
				'name' => 'hargaJual', 
				'required' => 'true', 
				'validators' => array(
					array(
						'name' => 'NotEmpty', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('isEmpty' => 'Harga Jual tidak boleh kosong')
						),  
					), 
					array(
						'name' => 'Digits', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('notDigits' => 'Harga Jual harus bertipe integer')
						),  
					),
					
				), 
				)));
			$this -> inputFilter = $inputFilter;
			return $this -> inputFilter;
		}
	}

}
?>
