<?php
namespace POS\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Search extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct('latihan/form'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'nama', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'class' => 'form-control',
                'placeholder' => 'searchNama'
            ), 
            'options' => array( 
                'label' => 'Nama Barang', 
            ), 
        )); 
 
        
		$this->add(array(
            'name' => 'btnSubmit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'placeholder' => 'searchSubmit',
                'class' => 'btn btn-default',
                'value' => 'search'
            ),
        ));
		  
    } 
} 
?>