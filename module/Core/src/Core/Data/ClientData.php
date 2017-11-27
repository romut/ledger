<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.01.2017
 * Time: 12:24
 */

namespace Core\Data;


class ClientData extends Data implements ClientDataInterface {

    private $clientId;
    private $clientTypeId;

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientTypeId()
    {
        return $this->clientTypeId;
    }

    /**
     * @param int $id
     * @return ClientDataInterface
     */
    public function setClientId($id)
    {
        $this->set($this->clientId, $id);
        return $this;
    }

    /**
     * @param int $id
     * @return ClientDataInterface
     */
    public function setClientTypeId($id)
    {
        $this->set($this->clientTypeId, $id);
        return $this;
    }
}