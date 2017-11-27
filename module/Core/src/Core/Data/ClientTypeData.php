<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 15:59
 */

namespace Core\Data;


class ClientTypeData extends Data implements ClientTypeDataInterface {

    private $id, $name;
    /**
     * @return int
     */
    public function getClientTypeId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getClientTypeName()
    {
        return $this->name;
    }

    /**
     * @param int $id
     * @return ClientTypeDataInterface
     */
    public function setClientTypeId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return ClientTypeDataInterface
     */
    public function setClientTypeName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
}