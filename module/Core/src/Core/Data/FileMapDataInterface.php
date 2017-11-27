<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 10:17
 */

namespace Core\Data;


interface FileMapDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileMapId();

    /**
     * @return string
     */
    public function getFileMapName();

    /**
     * @param int $id
     * @return FileMapDataInterface
     */
    public function setFileMapId($id);

    /**
     * @param string $name
     * @return FileMapDataInterface
     */
    public function setFileMapName($name);
}