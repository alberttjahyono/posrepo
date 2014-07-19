<?php
namespace POS\Controller\Login;

use POS\Form\Login;
use POS\Form\Validator\LoginValidator; 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class LoginController extends AbstractActionController {

     
    public function loginAction(){
    	$auth = $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
    	if ($auth-> hasIdentity()) {
			return $this -> redirect() -> toRoute('main');
		}
    	$form = new Login();
		$request = $this -> getRequest();
		if ($request -> isPost()) {
			$formValidator = new LoginValidator();
			{
				$form->setInputFilter($formValidator->getInputFilter());
				$form->setData($request->getPost());
			} 
			if($form->isValid()) 
	        { 
				$auth = $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
		        $auth->getAdapter()->setIdentityValue($request -> getPost('username'));
		        $auth->getAdapter()->setCredentialValue($request -> getPost('password'));
		        $result = $auth->authenticate();  
				
				if ($result->isValid()) {
                    return $this->redirect()->toRoute('home');
                }
				else{
					$this -> flashmessenger() -> addMessage("Id/Password Salah");
					return $this->redirect()->toRoute('login');
				}
	        } 
		}
		return array('form' => $form, 'messages' => $this -> flashmessenger() -> getMessages());
    }

	    public function logoutAction()
    {
        $auth = $this->getServiceLocator()->get('doctrine.authenticationservice.orm_default');
        $auth->clearIdentity();
        return $this->redirect()->toRoute('login');
    }
}
?>