<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 9:57
 */

namespace Core\Data;


class FileMapEntryData extends Data implements FileMapEntryDataInterface {

    private $fileMapId;
    private $inputNo, $outputNo;

    /**
     * @return int
     */
    public function getFileMapId()
    {
        return $this->fileMapId;
    }

    /**
     * @return int
     */
    public function getInputNo()
    {
        return $this->inputNo;
    }

    /**
     * @return int
     */
    public function getOutputNo()
    {
        return $this->outputNo;
    }

    /**
     * @param int $id
     * @return FileMapEntryDataInterface
     */
    public function setFileMapId($id)
    {
        $this->set($this->fileMapId, $id);
        return $this;
    }

    /**
     * @param int $no
     * @return FileMapEntryDataInterface
     */
    public function setInputNo($no)
    {
        $this->set($this->inputNo, $no);
        return $this;
    }

    /**
     * @param int $no
     * @return FileMapEntryDataInterface
     */
    public function setOutputNo($no)
    {
        $this->set($this->outputNo, $no);
        return $this;
    }
}