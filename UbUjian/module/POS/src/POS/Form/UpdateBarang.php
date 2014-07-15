<?php
namespace POS\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class UpdateBarang extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct('pos/form'); 
        
        $this->setAttribute('method', 'post'); 
               
        $this->add(array( 
            'name' => 'nama', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            ), 
            'options' => array( 
                'label' => 'Nama', 
            ), 
        )); 
 		
		$this->add(array( 
            'name' => 'stok', 
            'type' => 'Zend\Form\Element\Hidden', 
            'attributes' => array( 
            ), 
            'options' => array( 
            ), 
        )); 
		
        $this->add(array( 
            'name' => 'hargaBeli', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            ), 
            'options' => array( 
                'label' => 'Harga Beli', 
            ), 
        )); 
		
		$this->add(array( 
            'name' => 'hargaJual', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            ), 
            'options' => array( 
                'label' => 'Harga Jual', 
            ), 
        )); 
		
		$this->add(array( 
            'name' => 'status', 
            'type' => 'Zend\Form\Element\Hidden', 
            'attributes' => array( 
            ), 
            'options' => array( 
            ), 
        )); 
		$this->add(array(
            'name' => 'btnSubmit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Submit'
            ),
        ));
		  
    } 
} 
?>