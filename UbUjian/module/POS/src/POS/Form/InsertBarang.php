<?php
namespace POS\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class InsertBarang extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct('post/form'); 
        
        $this->setAttribute('method', 'post'); 
               
        $this->add(array( 
            'name' => 'nama', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Nama Barang', 
            ), 
        )); 
 		
		$this->add(array( 
            'name' => 'stok', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array(
                'class' => 'form-control', 
            ), 
            'options' => array( 
                'label' => 'Jumlah', 
            ), 
        )); 
		
        $this->add(array( 
            'name' => 'hargaBeli', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Harga Beli', 
            ), 
        )); 
				
		$this->add(array(
            'name' => 'btnSubmit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'class' => 'btn btn-default',
                'value' => 'Submit'
            ),
        ));
		  
    } 
} 
?>