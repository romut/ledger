<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:42
 */

namespace Core\Model;


use Core\Data\FileTypeCellData;
use Core\Data\FileTypeCellDataInterface;

class FileTypeCell extends Model implements FileTypeCellInterface {

    static public $tableDescriptor = array(
        'file_type_cells' => array(
            'alias' => 'ftc',
            'keys' => array('file_type_id', 'cell_no'),
        ),
    );

    static public function createDataArray() { return array(new FileTypeCellData()); }

    /**
     * @var CellTypeInterface $cellType
     * @var FileTypeInterface $fileType
     */
    private $fileType, $cellType;

    /**
     * @param int $part
     * @return FileTypeCellDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return FileTypeInterface
     */
    public function getFileType()
    {
        if (is_null($this->fileType) && !is_null($this->getData()->getFileTypeId())) {

            $this->fileType = $this->getStorage()->select(
                'Core\Model\FileType',
                array('id' => $this->getData()->getFileTypeId())
            );
        }

        return $this->fileType;
    }

    /**
     * @return int
     */
    public function getCellNo()
    {
        return $this->getData()->getCellNo();
    }

    /**
     * @return CellTypeInterface
     */
    public function getCellType()
    {
        if (is_null($this->fileType) && !is_null($this->getData()->getCellTypeId())) {

            $this->cellType = $this->getStorage()->select(
                'CellType',
                array('id' => $this->getData()->getCellTypeId())
            );
        }

        return $this->cellType;
    }

    /**
     * @param FileTypeInterface $fileType
     * @return FileTypeCellInterface
     */
    public function setFileType(FileTypeInterface $fileType)
    {
        $this->fileType = $fileType;
        $this->getData()->setFileTypeId($fileType->getId());

        return $this;
    }

    /**
     * @param int $no
     * @return FileTypeCellInterface
     */
    public function setCellNo($no)
    {
        $this->getData()->setCellNo($no);
        return $this;
    }

    /**
     * @param CellTypeInterface $cellType
     * @return FileTypeCellInterface
     */
    public function setCellType(CellTypeInterface $cellType)
    {
        $this->cellType = $cellType;
        $this->getData()->setCellTypeId($cellType->getId());

        return $this;
    }

    public function validate($value)
    {
        return true;
    }
}