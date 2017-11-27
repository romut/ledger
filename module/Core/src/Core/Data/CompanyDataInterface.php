<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 16:00
 */

namespace Core\Data;


interface CompanyDataInterface extends DataInterface
{

    /**
     * @return int
     */
    public function getCompanyId();

    /**
     * @return string
     */
    public function getCompanyCode();

    /**
     * @return string
     */
    public function getCompanyName();

    /**
     * @return string
     */
    public function getCompanyShortName();

    /**
     * @param int $id
     * @return CompanyDataInterface
     */
    public function setCompanyId($id);

    /**
     * @param string $code
     * @return CompanyDataInterface
     */
    public function setCompanyCode($code);


    /**
     * @param string $name
     * @return ClientDataInterface
     */
    public function setCompanyName($name);

    /**
     * @param string $name
     * @return ClientDataInterface
     */
    public function setCompanyShortName($name);
}