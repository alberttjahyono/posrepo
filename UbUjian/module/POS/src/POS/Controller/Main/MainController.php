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
   		$namaUser = $this->authPlugin()->getLoginData();
		$objectManager = $this -> getServiceLocator() -> get('Doctrine\ORM\EntityManager');
        $request = $this->getRequest();
        
        if ($request->isPost()){
  			$queryBuilder = $objectManager->createQueryBuilder()
				->select('u')
				->from('POS\Model\Entity\Barang', 'u')
				->where('u.NAMA like :input')->setParameter('input', '%'.$request->getPost("nama").'%')
				->orderBy('u.ID_BARANG', 'ASC');			
        }else{
        	$queryBuilder = $objectManager->createQueryBuilder()
				->select('u')
				->from('POS\Model\Entity\Barang' , 'u')
				->orderBy('u.ID_BARANG', 'ASC');
        }   
        $query = $queryBuilder->getQuery();
		$barang = $query->getResult();

		
        $matches = $this->getEvent()->getRouteMatch();
		$page = $matches->getParam('page', 1);
		$paginator = new Paginator(new Collection(new ArrayCollection($barang)));
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage(10);

		return array('paginator'=>$paginator,'lang'=>$matches->getParam('lang','en'),'messages'=>$this -> flashmessenger(),'form'=>new Search(),'namaUser'=>$namaUser);
    }
}
?>