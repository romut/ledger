<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.01.2017
 * Time: 12:18
 */

namespace Core\Data;


interface ClientDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getClientId();

    /**
     * @return int
     */
    public function getClientTypeId();

    /**
     * @param int $id
     * @return ClientDataInterface
     */
    public function setClientId($id);

    /**
     * @param int $id
     * @return ClientDataInterface
     */
    public function setClientTypeId($id);
}