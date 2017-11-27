<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 10:20
 */

namespace Core\Data;


class FileMapData extends Data implements FileMapDataInterface {

    private $id, $name;
    /**
     * @return int
     */
    public function getFileMapId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFileMapName()
    {
        return $this->name;
    }

    /**
     * @param int $id
     * @return FileMapDataInterface
     */
    public function setFileMapId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return FileMapDataInterface
     */
    public function setFileMapName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
}