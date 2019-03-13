<?php
namespace Customer\Model;

class PhoneNumber
{
    /*
     * Constructing and validating Phone attribuites
     */
    public function __construct($phone)
    {
        $arrPhone = array();
        $arrPhone = explode(' ', trim($phone));
        
        if(count($arrPhone) > 0) {
            $this->code = filter_var($arrPhone[0], FILTER_SANITIZE_NUMBER_INT);
            $this->number = filter_var($arrPhone[1], FILTER_SANITIZE_NUMBER_INT);
            $this->state = 'NOK';
            
            switch ($this->code) {
                case 237:
                    if(preg_match("/\(237\)\ ?[2368]\d{7,8}$/", $phone))
                        $this->state = 'OK';
                    break;
                case 251:
                    if(preg_match("/\(251\)\ ?[1-59]\d{8}$/", $phone))
                        $this->state = 'OK';
                    break;
                case 212:
                    if(preg_match("/\(212\)\ ?[5-9]\d{8}$/", $phone))
                        $this->state = 'OK';
                    break;
                case 258:
                    if(preg_match("/\(258\)\ ?[28]\d{7,8}$/", $phone))
                        $this->state = 'OK';
                    break;
                case 256:
                    if(preg_match("/\(256\)\ ?\d{9}$/", $phone))
                        $this->state = 'OK';
                    break;
            }
        }
    }
    
    /*
     * @var string
     */
    private $state;
    
    /*
     * @var string
     */
    private $code;
    
    /*
     * @var string
     */
    private $number;

    /**
     * @return string 
     */
    function getState() : string 
    {
        return $this->state;
    }

    /**
     * @return string 
     */
    function getCode() : string 
    {
        return $this->code;
    }

    /**
     * @return string 
     */
    function getNumber() : string 
    {
        return $this->number;
    }

    /**
     * @param string $state
     */
    function setState($state) : void
    {
        $this->state = $state;
    }

    /**
     * @param string $code
     */
    function setCode($code) : void
    {
        $this->code = $code;
    }

    /**
     * @param string $number
     */
    function setNumber($number) : void 
    {
        $this->number = $number;
    }
}