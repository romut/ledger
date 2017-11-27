<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 15:56
 */

namespace Core\Data;


interface ClientTypeDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getClientTypeId();

    /**
     * @return string
     */
    public function getClientTypeName();

    /**
     * @param int $id
     * @return ClientTypeDataInterface
     */
    public function setClientTypeId($id);

    /**
     * @param string $name
     * @return ClientTypeDataInterface
     */
    public function setClientTypeName($name);
} 