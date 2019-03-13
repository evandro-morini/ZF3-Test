<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Model\CustomerTable;

class IndexController extends AbstractActionController
{
    private $table;
    
    const COUNTRIES = array(
        237 => 'Cameroon',
        251 => 'Ethiopia',
        212 => 'Morocco',
        258 => 'Mozambique',
        256 => 'Uganda'
    );
    
    public function __construct(CustomerTable $table) 
    {
        $this->table = $table;
    }
    
    public function indexAction()
    {
        $customers = $this->table->load();
        if(count($customers) > 0) {
            $phones = $this->table->extractPhoneNumbers($customers);
        }
        
        return new ViewModel([
            'phones' => $phones,
            'countries' => self::COUNTRIES
        ]);
    }
    
    public function ajaxAction()
    {   
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);

        if ($this->getRequest()->isPost()) {
            $request = $this->getRequest()->getPost();
            if(!empty($request['country'])) {
                $customers = $this->table->getCustomersByCountry($request['country']);
            } else {
                $customers = $this->table->load();
            }
            if(count($customers) > 0) {
                $phones = $this->table->extractPhoneNumbers($customers, $request['state']);
            }
            $viewModel->setVariable('countries', self::COUNTRIES);
            $viewModel->setVariable('phones', $phones);
            return $viewModel;
        }
    }
}
