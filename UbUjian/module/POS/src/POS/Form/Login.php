<?php
namespace POS\Form; 

use Zend\Captcha; 
use Zend\Form\Element; 
use Zend\Form\Form; 

class Login extends Form 
{ 
    public function __construct($name = null) 
    { 
        parent::__construct('pos/form'); 
        
        $this->setAttribute('method', 'post'); 
        
        $this->add(array( 
            'name' => 'username', 
            'type' => 'Zend\Form\Element\Text', 
            'attributes' => array( 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Username', 
            ), 
        )); 
 
        $this->add(array( 
            'name' => 'password', 
            'type' => 'Zend\Form\Element\Password', 
            'attributes' => array( 
                'class' => 'form-control',
            ), 
            'options' => array( 
                'label' => 'Password', 
            ), 
        )); 

		$this->add(array(
            'name' => 'btnSubmit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'class' => 'btn btn-default',
                'value' => 'Login'
            ),
        ));
		  
    } 
} 
?>