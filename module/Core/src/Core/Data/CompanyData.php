<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 16:06
 */

namespace Core\Data;


class CompanyData extends Data implements CompanyDataInterface {

    private $companyId;
    private $code;
    private $name, $shortName;

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getCompanyCode()
    {
        return $this->code;
    }

    public function getCompanyName()
    {
        return $this->name;
    }

    public function getCompanyShortName()
    {
        return $this->shortName;
    }

    /**
     * @param int $id
     * @return CompanyDataInterface
     */
    public function setCompanyId($id)
    {
        $this->set($this->companyId, $id);
        return $this;
    }

    /**
     * @param string $code
     * @return CompanyDataInterface
     */
    public function setCompanyCode($code)
    {
        $this->set($this->code,$code);
        return $this;
    }

    public function setCompanyName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    public function setCompanyShortName($name)
    {
        $this->set($this->shortName, $name);
        return $this;
    }
}