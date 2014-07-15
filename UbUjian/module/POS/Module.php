<?php
namespace POS;

use POS\Helper\Requesthelper;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
class Module implements AutoloaderProviderInterface {
	public function getAutoloaderConfig() {
		return array('Zend\Loader\ClassMapAutoloader' => array(__DIR__ . '/autoload_classmap.php', ), 'Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__, ), ), );
	}

	public function getConfig() {
		return
		include __DIR__ . '/config/module.config.php';
	}

	public function getServiceConfig() {
		return ;
	}
	
	public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'Requesthelper' => function($sm){
                        $helper = new Requesthelper();
                        $request = $sm->getServiceLocator()->get('Request');
                        $helper->setRequest($request);
                         
                        return $helper;
               }
            ),
        );
    }

}
?>