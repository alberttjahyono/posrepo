<?php
namespace POS\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Transaksi extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct('post/form'); 
        
        $this->setAttribute('method', 'post'); 
               
        $this->add(array( 
            'name' => 'namaBarang', 
            'type' => 'Zend\Form\Element\Select', 
            'attributes' => array( 
            ), 
            'options' => array( 
                'label' => 'Nama Barang',
                'value_options' => array(
                '' => '',
            ), 
            ), 
        )); 
 		
		$this->add(array( 
            'name' => 'stok', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
            ), 
            'options' => array( 
                'label' => 'Jumlah', 
            ), 
        )); 

				
		$this->add(array(
            'name' => 'btnSubmit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Tambah'
            ),
        ));
		  
    } 
} 
?>