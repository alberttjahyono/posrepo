<?php
namespace POS\Controller\Plugin;
 
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
 
class authPlugin extends AbstractPlugin{
	
    public function getLoginData(){
    	$auth = $this->getController()->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
    	if (!$auth-> hasIdentity()) {
			return $this->getController() -> redirect() -> toRoute('login');
		}
		else{
			return $auth-> getIdentity()->getUsername();
		}
    }
}