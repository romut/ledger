<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 9:50
 */

namespace Core\Data;


interface FileMapEntryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileMapId();

    /**
     * @return int
     */
    public function getInputNo();

    /**
     * @return int
     */
    public function getOutputNo();

    /**
     * @param int $id
     * @return FileMapEntryDataInterface
     */
    public function setFileMapId($id);

    /**
     * @param int $no
     * @return FileMapEntryDataInterface
     */
    public function setInputNo($no);

    /**
     * @param int $no
     * @return FileMapEntryDataInterface
     */
    public function setOutputNo($no);
} 