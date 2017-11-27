<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 10:36
 */

namespace Core\Data;


class ClientFileMapData extends Data implements ClientFileMapDataInterface {

    private $clientId;
    private $fileTypeId;
    private $fileMapId;

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->clientId;
    }

    /**
     * @return int
     */
    public function getFileTypeId()
    {
        return $this->fileTypeId;
    }

    /**
     * @return int
     */
    public function getFileMapId()
    {
        return $this->fileMapId;
    }

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setCompanyId($id)
    {
        $this->set($this->clientId, $id);
        return $this;
    }

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setFileTypeId($id)
    {
        $this->set($this->fileTypeId, $id);
        return $this;
    }

    /**
     * @param int $id
     * @return ClientFileMapDataInterface
     */
    public function setFileMapId($id)
    {
        $this->set($this->fileMapId, $id);
        return $this;
    }
}