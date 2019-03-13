<?php
namespace Customer\Model;

class Customer
{
    /*
     * @var integer
     */
    private $id;
    
    /*
     * @var string
     */
    private $name;
    
    /*
     * @var string
     */
    private $phone;
    
    /**
     * @return integer 
     */
    function getId() : int 
    {
        return $this->id;
    }

    /**
     * @return string 
     */
    function getName() : string 
    {
        return $this->name;
    }

    /**
     * @return string 
     */
    function getPhone() : string
    {
        return $this->phone;
    }

    /**
     * @param integer $id
     */
    function setId($id) : void 
    {
        $this->id = $id;
    }
    
    /**
     * @param string $name
     */
    function setName($name) : void 
    {
        $this->name = $name;
    }

    /**
     * @param string $phone
     */
    function setPhone($phone) : void 
    {
        $this->phone = $phone;
    }

    /**
     * @param array $data
     */
    public function exchangeArray(array $data) : void
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        $this->name = !empty($data['name']) ? $data['name'] : null;
        $this->phone  = !empty($data['phone']) ? $data['phone'] : null;
    }
}