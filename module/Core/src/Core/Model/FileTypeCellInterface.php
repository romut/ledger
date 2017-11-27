<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:37
 */

namespace Core\Model;


interface FileTypeCellInterface extends ModelInterface {

    /**
     * @return FileTypeInterface
     */
    public function getFileType();

    /**
     * @return int
     */
    public function getCellNo();

    /**
     * @return CellTypeInterface
     */
    public function getCellType();

    /**
     * @param FileTypeInterface $fileType
     * @return FileTypeCellInterface
     */
    public function setFileType(FileTypeInterface $fileType);

    /**
     * @param int $no
     * @return FileTypeCellInterface
     */
    public function setCellNo($no);

    /**
     * @param CellTypeInterface $cellType
     * @return FileTypeCellInterface
     */
    public function setCellType(CellTypeInterface $cellType);

    /**
     * @param $value
     * @return FileTypeCellInterface
     */
    public function validate($value);
} 