<?php
namespace POS\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class TransaksiValidator implements InputFilterAwareInterface {
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
				'name' => 'stok', 
				'required' => 'true', 
				'validators' => array( 
					array(
						'name' => 'NotEmpty', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('isEmpty' => 'Jumlah tidak boleh kosong !')
						),  
					),
					array(
						'name' => 'Digits', 
						'break_chain_on_failure' => true,
						'options' => array(
							'messages' => array('notDigits' => 'Jumlah harus bertipe integer !')
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
