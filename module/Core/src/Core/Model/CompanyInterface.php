<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 18.01.2017
 * Time: 18:38
 */

namespace Core\Model;


interface CompanyInterface extends ClientInterface {

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return CompanyInterface
     */
    public function setCode($code);
}