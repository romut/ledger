<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 08.07.2016
 * Time: 16:29
 */

namespace Core\Model;


interface FileRowInterface extends \Iterator, \Countable, \ArrayAccess {

    /**
     * @param FileMapInterface $fileMap
     * @return FileRowInterface
     */
    public function setFileMap(FileMapInterface $fileMap);

    /**
     * @param int $column
     * @return FileCellInterface
     */
    public function getCell($column);

    /**
     * @param FileCellInterface $cell
     * @return FileRowInterface
     */
    public function addCell(FileCellInterface $cell);

    /**
     * @return int
     */
    public function getRowNo();

    /**
     * @param int $rowNo
     * @return FileRowInterface
     */
    public function setRowNo($rowNo);

    /**
     * @return bool
     */
    public function isEmpty();
} 