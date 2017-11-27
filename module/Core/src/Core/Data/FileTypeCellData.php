<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:46
 */

namespace Core\Data;


class FileTypeCellData extends Data implements FileTypeCellDataInterface {

    /**
     * @var int $fileTypeId
     * @var int $cellNo
     * @var int $cellTypeId
     */
    private $fileTypeId;
    private $cellNo;
    private $cellTypeId;

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
    public function getCellNo()
    {
        return $this->cellNo;
    }

    /**
     * @return int
     */
    public function getCellTypeId()
    {
        return $this->cellTypeId;
    }

    /**
     * @param int $id
     * @return FileTypeCellDataInterface
     */
    public function setFileTypeId($id)
    {
        $this->set($this->fileTypeId, $id);
        return $this;
    }

    /**
     * @param int $no
     * @return FileTypeCellDataInterface
     */
    public function setCellNo($no)
    {
        $this->set($this->cellNo, $no);
        return $this;
    }

    /**
     * @param int $id
     * @return FileTypeCellDataInterface
     */
    public function setCellTypeId($id)
    {
        $this->set($this->cellTypeId, $id);
        return $this;
    }
}