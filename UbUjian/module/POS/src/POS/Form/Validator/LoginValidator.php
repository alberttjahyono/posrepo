<?php
namespace POS\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class LoginValidator implements InputFilterAwareInterface {
	protected $inputFilter;

	public function setInputFilter(InputFilterInterface $inputFilter) {
		throw new \Exception("Not used");
	}

	public function getInputFilter() {
		if (!$this -> inputFilter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory();

			$inputFilter -> add($factory -> createInput(array('name' => 'username', 'required' => 'true', 'validators' => array(), )));
			$inputFilter -> add($factory -> createInput(array('name' => 'password', 'required' => 'true', 'validators' => array(), )));
	
			$this->inputFilter = $inputFilter;
			return $this -> inputFilter;
		}
	}

}
?>
