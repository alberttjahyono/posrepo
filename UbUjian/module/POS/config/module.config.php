<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'POS\Controller\Login\Login' => 'POS\Controller\Login\LoginController',
            'POS\Controller\Main\Main' => 'POS\Controller\Main\MainController',
            'POS\Controller\Report\Report' => 'POS\Controller\Report\ReportController',
            'POS\Controller\Edit\Edit' => 'POS\Controller\Edit\EditController',
            'POS\Controller\Delete\Delete' => 'POS\Controller\Delete\DeleteController',
            'POS\Controller\Transaksi\Insert' => 'POS\Controller\Transaksi\InsertController',
            'POS\Controller\Transaksi\Transaksi' => 'POS\Controller\Transaksi\TransaksiController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	'login' => array(
            	'type'    => 'Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Login\Login',
                    	'action'        => 'login',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'authenticate' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
            'main' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:lang]/main[/:page]',
                    'defaults' => array(
                        'controller'    => 'POS\Controller\Main\Main',
                        'action'        => 'main',
                    ),
                ),
            ),
            'report' => array(
            	'type'    => 'Literal',
                'options' => array(
                    'route'    => '/report',
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Report\Report',
                    	'action'        => 'report',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pdf' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                    'excel' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                    'chart' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
            'insert' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/insert',
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Transaksi\Insert',
                    	'action' => 'insert',
                    ),

                ),
            ),
			
			'transaksi' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/transaksi/[:action]',
                    'constraints' => array(
                       'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Transaksi\Transaksi',
                    ),

                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'beli' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        ),
                    ),
                ),
            ),
			
            'edit' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/edit/[:action]/:id[/]',
                    'constraints' => array(
                   		'id'     => '[0-9]+',
                   		'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
               		 ),
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Edit\Edit',
                    ),

                ),
            ),
            'delete' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/delete/[:action]/:id[/]',
                    'constraints' => array(
                   		'id'     => '[0-9]+',
                   		'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
               		 ),
                    'defaults' => array(
                    	'controller'    => 'POS\Controller\Delete\Delete',
                    ),

                ),
            ),
            
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'POS' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'formelementerrors' => 'POS\Helper\FormErrorHelper'
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            'authPlugin' => 'POS\Controller\Plugin\authPlugin',
        )
    ),
    'template_map' => array(
		'layout/blank' => __DIR__ . '/../view/layout/blank.phtml',
	), 
    'doctrine' => array(
        'driver' => array(
            'pos_xml' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/POS/XML')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'POS\Model\Entity' => 'pos_xml'
                )
            )
		),
		'authentication' => array(
            'orm_default' => array(
                //should be the key you use to get doctrine's entity manager out of zf2's service locator
                'objectManager' => 'Doctrine\ORM\EntityManager',
                //fully qualified name of your user class
                'identityClass' => 'POS\Model\Entity\User',
                //the identity property of your class
                'identityProperty' => 'username',
                //the password property of your class
                'credentialProperty' => 'password',
            ),
        ),
	),
);

?>