<?php
namespace POS\Controller\Main;

use POS\Form\Search;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Collection;
use Zend\Paginator\Paginator;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class MainController extends AbstractActionController {

     
    public function mainAction(){
   		$namaUser = $this->AuthPlugin()->getLoginData();
		
		
		$matches = $this->getEvent()->getRouteMatch();
		$page = $matches->getParam('page', 1);

		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');

		$form = new Search();
        $request = $this->getRequest();
        
        if ($request->isPost()){
  			$queryBuilder = $objectManager->createQueryBuilder()
				->select('u')
				->from('POS\Model\Entity\Barang', 'u')
				->where('u.NAMA like :input')->setParameter('input', '%'.$request->getPost("nama").'%')
				->orderBy('u.NAMA', 'ASC');
				
			$query = $queryBuilder->getQuery();
			$barang = $query->getResult();
        }else{
        	$queryBuilder = $objectManager->createQueryBuilder()
				->select('u')
				->from('POS\Model\Entity\Barang' , 'u')
				->orderBy('u.ID_BARANG', 'ASC');
			$query = $queryBuilder->getQuery();
			$barang = $query->getResult();
        }   
		$collection = new ArrayCollection($barang);
		$paginator = new Paginator(new Collection($collection));

		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(10);

		return array('paginator'=>$paginator,'lang'=>$matches->getParam('lang','en'),'messages'=>$this -> flashmessenger(),'form'=>$form,'namaUser'=>$namaUser);
    }
}
?>