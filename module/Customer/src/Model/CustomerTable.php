<?php
namespace Customer\Model;

use RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Customer\Model\PhoneNumber;

class CustomerTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function load()
    {
        return $this->tableGateway->select();
    }

    public function getCustomersByCountry($countryCode)
    {
        $countryCode = (int) $countryCode;
        return $this->tableGateway->select(["phone LIKE '%({$countryCode})%'"]);
    }
    
    public function extractPhoneNumbers($arrCustomers, $state = null) 
    {
        $arrPhoneNumbers = array();
        foreach($arrCustomers as $customer) {
            $phone = new PhoneNumber($customer->getPhone());
            if(!empty($state)) {
                if($state === $phone->getState()) {
                    $arrPhoneNumbers[] = $phone;
                }
            } else {
                $arrPhoneNumbers[] = $phone;
            }
        }
        return $arrPhoneNumbers;
    }
}

